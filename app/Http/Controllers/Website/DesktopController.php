<?php

namespace App\Http\Controllers\Website;

use App\Models\Banner;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesktopController extends Controller
{
    //
    function index()
    {
        $cate = Category::all();
        $banners = Banner::orderBy('order', 'desc')->where('status', '=', '1')->get();
        return view('website.desktop.desktop', compact('cate', 'banners'));
    }
    public function showCategory()
    {
        $cate = Category::withCount('products')->get();
        return view('website.desktop.categories',compact('cate'));
    }
}
