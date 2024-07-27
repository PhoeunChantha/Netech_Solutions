<?php

namespace App\Http\Controllers\website;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MacController extends Controller
{
    //
    function index(){
        $cate = Category::all();
        $banners = Banner::orderBy('order', 'desc')->where('status', '=', '1')->get();
        return view('website.mac.mac', compact('cate', 'banners'));
    }
}
