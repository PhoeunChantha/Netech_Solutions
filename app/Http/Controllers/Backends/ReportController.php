<?php

namespace App\Http\Controllers\Backends;

use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('orderdetails', 'customer');
    
        // ✅ Filter by Customer Name
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }
    
        // ✅ Filter by Order Date
        if ($request->filled('order_date')) {
            $query->whereDate('created_at', $request->order_date);
        }
    
        // ✅ Filter by Date Range
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }
    
        // ✅ Filter by Minimum & Maximum Total Amount
        if ($request->filled('min_total') && $request->filled('max_total')) {
            $query->whereBetween('total_amount', [$request->min_total, $request->max_total]);
        }
    
        // ✅ Fetch filtered reports
        $reports = $query->latest('id')->paginate(10);
    
        // ✅ Get customers for filter dropdown
        $customers = Customer::where('status', 1)->select('id', 'first_name', 'last_name')->get();
    
        return view('backends.reports.report', compact('reports', 'customers'));
    }
    
    public function Reportdetail($id)
    {
        $report = Order::find($id);
        $items = OrderDetail::with('product')->where('order_id', $report->id)->get();
       return view('backends.reports.report_detail', compact('report', 'items'));
    }
}
