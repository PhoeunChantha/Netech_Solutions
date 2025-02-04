<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function index(){

        $reports = Order::with('orderdetails')->get();
        return view('backends.reports.report', compact('reports'));
    }
}
