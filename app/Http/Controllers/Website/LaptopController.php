<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    //
    function index(){
        return view('website.laptop.laptop');
    }
}
