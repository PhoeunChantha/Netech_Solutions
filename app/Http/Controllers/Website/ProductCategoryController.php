<?php

namespace App\Http\Controllers\Website;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class ProductCategoryController extends Controller
{
    // public function showDesktop()
    // {
    //     $cate = Category::all();
    //     $banners = Banner::orderBy('order', 'desc')->where('status', '=', '1')->get();
    //     return view('website.desktop.desktop', compact('cate', 'banners'));
    // }
    // public function showLaptop()
    // {
    //     $cate = Category::all();
    //     $banners = Banner::orderBy('order', 'desc')->where('status', '=', '1')->get();
    //     return view('website.laptop.laptop', compact('cate', 'banners'));
    // }
    // public function showMac()
    // {
    //     $cate = Category::all();
    //     $banners = Banner::orderBy('order', 'desc')->where('status', '=', '1')->get();
    //     return view('website.mac.mac', compact('cate', 'banners'));
    // }
    public function showCategoryProducts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();
        $productscount = $products->count();
        // dd($products);
        return view('website.desktop.desktop', compact('category', 'productscount', 'products'));
    }
    public function showservice()
    {
        // $category = Category::where('slug', $slug)->firstOrFail();
        $services = Service::all();
        // dd($products);
        return view('website.servicespage.service', compact('services'));
    }
}
