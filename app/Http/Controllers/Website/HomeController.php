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
        $category = Category::where('name', 'desktop')->first();
        if ($category) {
            $products = $category->products()->paginate(10);
        } else {
            $products = collect(); // No products if category not found
        }
        return view('website.home.home', compact('products'));
    }
}
