<?php

namespace App\Http\Controllers\Website;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaptopController extends Controller
{
    //
    function index(){
        $cate = Category::all();
        $banners = Banner::orderBy('order', 'desc')->where('status', '=', '1')->get();
        return view('website.laptop.laptop', compact('cate', 'banners'));

    }
}
