<?php

namespace App\Http\Controllers\Website;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
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
        $desktopCategory = Category::where('name', 'desktop')->pluck('id')->first();
        $laptopCategory = Category::where('name', 'laptop')->pluck('id')->first();
        $accessoriesCategory = Category::where('name', 'accessories')->pluck('id')->first();
        $cctvCategory = Category::where('name', 'cctv')->pluck('id')->first();
        $printerCategory = Category::where('name', 'printer')->pluck('id')->first();

        // Fetch products for each category
        $desktopProducts = Product::where('category_id', $desktopCategory)->paginate(10);
        $laptopProducts = Product::where('category_id', $laptopCategory)->paginate(10);
        $accessoriesProducts = Product::where('category_id', $accessoriesCategory)->paginate(10);
        $cctvProducts = Product::where('category_id', $cctvCategory)->paginate(10);
        $printerProducts = Product::where('category_id', $printerCategory)->paginate(10);
        if (!$desktopProducts || !$laptopProducts || !$accessoriesProducts || !$cctvProducts || !$printerProducts) {
            return abort(404); // Return 404 if no products found for either 'desktop' or 'laptop' categories
        }
        return view('website.home.home', compact('desktopProducts', 'laptopProducts', 'accessoriesProducts', 'cctvProducts', 'printerProducts'));
    }
    public function showCategoryProducts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();
        $productscount = $products->count();
        // dd($products);
        return view('website.desktop.desktop', compact('category', 'productscount', 'products'));
    }
}
