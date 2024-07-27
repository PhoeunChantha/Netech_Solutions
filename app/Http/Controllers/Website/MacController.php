<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MacController extends Controller
{
    //
    function index(){
        return view('website.mac.mac');
    }
}
