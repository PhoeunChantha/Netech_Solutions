<?php

namespace App\Http\Controllers\Website;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $cate = Category::all();
        $banners = Banner::orderBy('order', 'desc')->where('status', '=', '1')->get();
        return view('website.home.home', compact('cate', 'banners'));
    }
}
