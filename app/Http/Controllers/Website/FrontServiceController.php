<?php

namespace App\Http\Controllers\Website;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontServiceController extends Controller
{

    public function index()
    {
        // $category = Category::where('slug', $slug)->firstOrFail();
        $services = Service::all();
        // dd($products);
        return view('website.servicespage.service', compact('services'));
    }
}
