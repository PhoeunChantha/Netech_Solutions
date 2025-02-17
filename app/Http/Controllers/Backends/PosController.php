<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\OrderDetail;
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
    public function index()
    {
        // dd(1);
        $customers = Customer::where('status', 1)->get();
        $categories_pos = Category::where('status', 1)->get();
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.pos.create', compact('language', 'default_lang', 'categories_pos', 'customers'));
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
        // Validation
        // $validator = Validator::make($request->all(), [
        //     'customer_id' => 'required|integer|exists:customers,id',
        //     'product_id' => 'required|array',
        //     'product_id.*' => 'integer|exists:products,id',
        //     'order_quantity' => 'required|array',
        //     'order_quantity.*' => 'integer|min:1',
        //     'price' => 'required|array',
        //     'price.*' => 'numeric|min:0',
        //     'payment_method' => 'required|string',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => 0,
        //         'msg' => __('Invalid Information'),
        //         'errors' => $validator->errors(),
        //     ], 422);
        // }

        try {
            DB::beginTransaction();
        
            // Save order
            $order = new Order();
            $order->customer_id = $request->customer_id;
            $order->receive_amount = $request->recieve_amount ?? 0;
            $order->order_number = $request->order_number;
            $order->total_amount = $request->total;
            $order->user_id = auth()->user()->id ?? null;
            $order->discount_amount = $request->totaldiscount ?? 0;
            $order->payment_method = $request->payment_method;
            $order->payment_mote = $request->payment_notes ?? '';
            $order->total_before_discount = $request->sub_total_before_discount ?? '';
            $order->save();
        
            // Save order details
            if (!empty($request->orders) && is_array($request->orders)) {
                foreach ($request->orders as $product) {
                    $orderDetails = new OrderDetail();
                    $orderDetails->order_id = $order->id;
                    $orderDetails->product_id = $product['product_id'];
                    $orderDetails->quantity = $product['quantity'];
                    $orderDetails->unit_price = $product['unit_price'];
                    $orderDetails->price = $product['subtotal'];
                    $orderDetails->discount = $product['discount'];
                    $orderDetails->save();

                    $productModel = Product::find($product['product_id']);
                    if ($productModel) {
                        $productModel->quantity -= $product['quantity'];
                        if ($productModel->quantity < 0) {
                            throw new Exception(__('Insufficient stock for product: ') . $productModel->name);
                        }
                        $productModel->save();
                    }
                }
            } else {
                return response()->json([
                    'success' => 0,
                    'msg' => __('No products found in the order.'),
                ], 400);
            }
           
        
            DB::commit();
        
            return response()->json([
                'order_id' => $order->id,
                'success' => 1,
                'msg' => __('Order placed successfully'),
            ]);
        } catch (Exception $e) {
            dd($e);
            // DB::rollBack();
            // Log::error('Order Store Error:', ['error' => $e->getMessage()]);
            // return response()->json([
            //     'success' => 0,
            //     'msg' => __('Something went wrong. Please try again.'),
            // ], 500);
        }
    }
}
