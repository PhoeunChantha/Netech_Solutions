<?php

namespace App\Http\Controllers\Website;

use App\Models\Brand;
use App\Models\Video;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // $cate = Category::all();
        // $banners = Banner::orderBy('order', 'desc')->where('status', '=', '1')->get();
        // $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        //     ->where('categories.name', 'desktop')
        //     ->select('products.*')
        //     ->paginate(10);
        // Fetch category IDs for 'desktop' and 'laptop'
        $categories = Category::with('products')->where('status', 1)->take(4)->get();
        $desktopCategory = Category::where('name', 'desktop')->pluck('id')->first();
        $laptopCategory = Category::where('name', 'laptop')->pluck('id')->first();
        $accessoriesCategory = Category::where('name', 'accessories')->pluck('id')->first();
        $cctvCategory = Category::where('name', 'cctv')->pluck('id')->first();
        $printerCategory = Category::where('name', 'printer')->pluck('id')->first();

        $discounts = Discount::where('status', 1)->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest('id')->paginate(5);
        $discountedProductIds = [];
        $discountMapping = [];
        $discounttypeMapping = [];
        $discountStartDate = [];
        $discountendDate = [];

        foreach ($discounts as $discount) {
            foreach ($discount->product_ids as $productId) {
                $discountedProductIds[] = $productId;
                $discountMapping[$productId] = (float) $discount->discount_value;
                $discounttypeMapping[$productId] = (string) $discount->discount_type;
                $discountStartDate[$productId] = $discount->start_date;
                $discountendDate[$productId] = $discount->end_date;
            }
        }
        // dd($discountMapping);
        $productdiscounted = Product::whereIn('id', $discountedProductIds)
            ->where('status', 1)->latest('id')->paginate(4);


        $discountedProducts = Discount::where('status', 1)->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();

        $desktopProducts = Product::where('category_id', $desktopCategory)
            ->latest('id')
            ->paginate(5)
            ->through(function ($product) use ($discountedProducts) {
                $productDiscount = $discountedProducts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds);
                });
                $product->discount = $productDiscount;
                return $product;
            });

        $laptopProducts = Product::where('category_id', $laptopCategory)
            ->latest('id')
            ->paginate(5)
            ->through(function ($product) use ($discountedProducts) {
                $productDiscount = $discountedProducts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds);
                });
                $product->discount = $productDiscount; 
                return $product;
            });
        $accessoriesProducts = Product::where('category_id', $accessoriesCategory)
            ->latest('id')
            ->paginate(10)
            ->through(function ($product) use ($discountedProducts) {
                $productDiscount = $discountedProducts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds);
                });
                $product->discount = $productDiscount; 
                return $product;
            });
        $cctvProducts = Product::where('category_id', $cctvCategory)
            ->latest('id')
            ->paginate(5)
            ->through(function ($product) use ($discountedProducts) {
                $productDiscount = $discountedProducts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds);
                });
                $product->discount = $productDiscount; 
                return $product;
            });
       
        $printerProducts = Product::where('category_id', $printerCategory)
            ->latest('id')
            ->paginate(10)
            ->through(function ($product) use ($discountedProducts) {
                $productDiscount = $discountedProducts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds);
                });
                $product->discount = $productDiscount;
                return $product;
            });

        $latestProducts = Product::where('status', 1)
            ->latest('id')
            ->paginate(5)
            ->each(function ($product) use ($discounts) {
                $product->discount = $discounts->first(fn($discount) => in_array($product->id, $discount->product_ids));
            });
        $videos = Video::latest('id')->paginate(5);
        $services = Service::where('status', 1)->get();
        if (!$desktopProducts || !$laptopProducts || !$accessoriesProducts || !$cctvProducts || !$printerProducts) {
            return abort(404);
        }
        return view('website.home.home', compact(
            'desktopProducts',
            'categories',
            'laptopProducts',
            'accessoriesProducts',
            'cctvProducts',
            'printerProducts',
            'discounts',
            'productdiscounted',
            'latestProducts',
            'services',
            'discountMapping',
            'discounttypeMapping',
            'discountStartDate',
            'discountendDate',
            'videos'
        ));
    }
    public function showCategoryProducts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $discounts = Discount::where('status', 1)->whereDate('start_date', '<=', now()) // Ensure the discount has started
            ->whereDate('end_date', '>=', now())
            ->get();
        $products = Product::where('category_id', $category->id)
            ->latest('id')
            ->paginate(50)
            ->each(function ($product) use ($discounts) {
                $productDiscount = $discounts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds); // Check if product id is in product_ids
                });
                $product->discount = $productDiscount;
            });
        $productscount = $products->count();
        $brands = Brand::where('status', 1)->pluck('id', 'name');
        return view('website.desktop.desktop', compact('category', 'productscount', 'products', 'brands'));
    }
   
}
