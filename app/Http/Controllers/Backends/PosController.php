<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PosController extends Controller
{
    //
    public function index()
    {
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
    
}
