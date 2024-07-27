<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesktopController extends Controller
{
    //
    function index(){
        return view('website.desktop.desktop');
    }
}
