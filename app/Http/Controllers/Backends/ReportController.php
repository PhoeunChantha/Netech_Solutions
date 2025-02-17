<?php

namespace App\Http\Controllers\Backends;

use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    function index(){

        $reports = Order::with('orderdetails')->latest('id')->paginate(10);
        $customers = Customer::where('status', 1)->select('id', 'first_name', 'last_name')->get();
        return view('backends.reports.report', compact('reports','customers'));
    }
    public function Reportdetail($id)
    {
        $report = Order::find($id);
        $items = OrderDetail::with('product')->where('order_id', $report->id)->get();
       return view('backends.reports.report_detail', compact('report', 'items'));
    }
}
