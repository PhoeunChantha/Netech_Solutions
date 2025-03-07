<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\OrderDetail;
use App\Models\Transaction;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PosController extends Controller
{
    //
    // public function index()
    // {   
    //     return response()->json([
    //         'success' => 1,
    //         'msg' => __('Create successfully'),
    //     ]);
    //     // dd(1);
    //     $customers = Customer::where('status', 1)->get();
    //     $categories_pos = Category::where('status', 1)->get();
    //     $language = BusinessSetting::where('type', 'language')->first();
    //     $language = $language->value ?? null;
    //     $default_lang = 'en';
    //     $default_lang = json_decode($language, true)[0]['code'];
    //     return view('backends.pos.index', compact('language', 'default_lang', 'categories_pos', 'customers'));
       
    // }
    public function index()
    {   
       
        $customers = Customer::where('status', 1)->get();
        $categories_pos = Category::where('status', 1)->get();
       
        return view('backends.pos.index', compact('categories_pos', 'customers'));
       
    }
    public function pos_customer_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        if (is_null($request->first_name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'first_name',
                    'First name field is required!'
                );
            });
        }
        if (is_null($request->last_name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'last_name',
                    'Last name field is required!'
                );
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $customer = new Customer();
            $customer->first_name = $request->first_name[array_search('en', $request->lang)];
            $customer->last_name = $request->last_name[array_search('en', $request->lang)];
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->dob = $request->dob;
            $customer->phone = $request->phone;
            if ($request->hasFile('image')) {
                $customer->image = ImageManager::upload('uploads/customer/', $request->image);
            }

            $customer->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->first_name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Customer',
                        'translationable_id' => $customer->id,
                        'locale' => $key,
                        'key' => 'first_name',
                        'value' => $request->first_name[$index],
                    ];
                }
            }

            foreach ($request->lang as $index => $key) {
                if (isset($request->last_name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Customer',
                        'translationable_id' => $customer->id,
                        'locale' => $key,
                        'key' => 'first_name',
                        'value' => $request->last_name[$index],
                    ];
                }
            }
            Translation::insert($data);
            DB::commit();
            return response()->json(
                [
                    'success' => 1,
                    'msg' => __('Create successfully'),
                ]
            );
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return response()->json(
                [
                    'success' => 0,
                    'msg' => __('Something went wrong'),
                ]
            );
        }
    }

    public function posfilterProducts(Request $request)
    {
        $categoryId = $request->input('category_id');

        $discountedProducts = Discount::where('status', 1)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();

        if ($categoryId === 'all') {
            $products = Product::where('status', 1)->get()->map(function ($product) use ($discountedProducts) {
                $productDiscount = $discountedProducts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;

                    if (is_string($productIds)) {
                        $productIds = json_decode($productIds, true);
                    }

                    return is_array($productIds) && in_array($product->id, $productIds);
                });

                $product->discount = $productDiscount;
                return $product;
            });
        } else {
            $products = Product::where('category_id', $categoryId)
                ->where('status', 1)
                ->get()
                ->map(function ($product) use ($discountedProducts) {
                    $productDiscount = $discountedProducts->first(function ($discount) use ($product) {
                        $productIds = $discount->product_ids;

                        if (is_string($productIds)) {
                            $productIds = json_decode($productIds, true);
                        }

                        return is_array($productIds) && in_array($product->id, $productIds);
                    });

                    $product->discount = $productDiscount;
                    $product->discountedPrice = $productDiscount
                        ? $product->price - $product->price * ($productDiscount->discount_value / 100)
                        : $product->price;
                    return $product;
                });
        }

        $formattedProducts = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'thumbnail' => isset($product->thumbnail[0])
                    ? asset('uploads/products/' . $product->thumbnail[0])
                    : asset('uploads/default-product.png'),
                'quantity' => $product->quantity,
                'discount' => $product->discount,
                'discountedPrice' => $product->discountedPrice,
            ];
        });

        return response()->json([
            'success' => true,
            'products' => $formattedProducts,
        ]);
    }
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'nullable|string',
            'search_term' => 'nullable|string|max:255',
        ]);

        $categoryId = $validatedData['category_id'];
        $searchTerm = $validatedData['search_term'];

        $discountedProducts = Discount::where('status', 1)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();

        $products = Product::query()
            ->when($categoryId !== 'all', fn($query) => $query->where('category_id', $categoryId))
            ->when($searchTerm, fn($query) => $query->where('name', 'like', "%$searchTerm%"))
            ->where('status', 1)
            ->get()
            ->map(function ($product) use ($discountedProducts) {
                $productDiscount = $discountedProducts->first(
                    fn($discount) =>
                    in_array($product->id, is_string($discount->product_ids) ? json_decode($discount->product_ids, true) : $discount->product_ids)
                );
                $product->discount = $productDiscount;
                $product->discountedPrice = $productDiscount
                    ? $product->price - $product->price * ($productDiscount->discount_value / 100)
                    : $product->price;
                return $product;
            });


        $formattedProducts = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'thumbnail' => isset($product->thumbnail[0])
                    ? asset('uploads/products/' . $product->thumbnail[0])
                    : asset('uploads/default-product.png'),
                'quantity' => $product->quantity,
                'discount' => $product->discount,
                'discountedPrice' => $product->discountedPrice,
            ];
        });

        return response()->json([
            'success' => true,
            'products' => $formattedProducts,
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'customer_id' => 'required|integer|exists:customers,id',
            'orders' => 'required|array',
            'orders.*.product_id' => 'integer|exists:products,id',
            'orders.*.quantity' => 'integer|min:1',
            'orders.*.unit_price' => 'numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'msg' => __('Invalid Information'),
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            DB::beginTransaction();

            $order = new Order();
            $order->customer_id = $request->customer_id;
            $order->receive_amount = $request->recieve_amount ?? 0;
            $order->order_number = $request->order_number;
            $order->total_amount = $request->total;
            $order->user_id = auth()->user()->id ?? null;
            $order->discount_type = $request->discount_type;
            if ($request->discount_type == 'percent') {
                $order->discount = $request->totaldiscount ?? 0;
            } else {
                $order->discount_amount = $request->totaldiscount ?? 0;
            }
            $order->payment_method = $request->payment_method;
            $order->payment_note = $request->payment_notes ?? '';
            $order->total_before_discount = $request->sub_total_before_discount ?? '';
            $order->save();

            if (!isset($request->orders) || !is_array($request->orders) || empty($request->orders)) {
                return response()->json([
                    'success' => 0,
                    'msg' => __('No products found in the order.'),
                ], 400);
            }

            foreach ($request->orders as $product) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $product['product_id'];
                $orderDetail->quantity = $product['quantity'];
                $orderDetail->unit_price = $product['unit_price'];
                $orderDetail->price = $product['subtotal'];
                $orderDetail->discount = $product['discount'];
                $orderDetail->save();

                $productModel = Product::find($product['product_id']);
                if ($productModel) {
                    if ($productModel->quantity < $product['quantity']) {
                        throw new Exception(__('Insufficient stock for product: ') . $productModel->name);
                    }
                    $productModel->quantity -= $product['quantity'];
                    $productModel->save();
                }

                $transaction = new Transaction();
                $transaction->transaction_type = 'income';
                $transaction->order_id = $order->id;
                $transaction->product_id = $product['product_id'];
                $transaction->amount = $orderDetail->price;
                $transaction->quantity = $orderDetail->quantity;
                $transaction->transaction_date = now();
                $transaction->description = 'Sale of ' . $orderDetail->quantity . ' units';
                $transaction->save();
            }

            DB::commit();

            return response()->json([
                'order_id' => $order->id,
                'success' => 1,
                'msg' => __('Order placed successfully'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            Log::error('Order Store Error:', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => 0,
                'msg' => __('Something went wrong. Please try again.'),
            ], 500);
        }
    }
}
