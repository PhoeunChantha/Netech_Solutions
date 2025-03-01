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

        if ($request->ajax()) {
            $orderReport = Order::with('orderdetails', 'customer');

            if ($request->filled('customer_id')) {
                $orderReport->where('customer_id', $request->customer_id);
            }

            if ($request->filled('order_date')) {
                $orderReport->whereDate('created_at', $request->order_date);
            }

            if ($request->filled('date_from') && $request->filled('date_to')) {
                $orderReport->whereBetween('created_at', [$request->date_from, $request->date_to]);
            }

            if ($request->filled('total_amount_range')) {
                $amountRange = explode('-', $request->total_amount_range);
                if (count($amountRange) == 2) {
                    $orderReport->whereBetween('total_amount', [$amountRange[0], $amountRange[1]]);
                } else {
                    $orderReport->where('total_amount', '>=', $amountRange[0]);
                }
            }
            if (!empty($request->search_value)) {
                $search = trim($request->search_value);
                $orderReport->where(function ($query) use ($search) {
                    $query->where('order_number', 'like', "%{$search}%")
                          ->orWhere('discount', 'like', "%{$search}%")
                          ->orWhere('total_amount', 'like', "%{$search}%");
            
                    // ✅ Ensure customer search is included correctly
                    $query->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%");
                    });
                });
            }
            
            
            
            $totalamount = $orderReport->sum('total_amount');
            return datatables()->eloquent($orderReport)
            ->addColumn('order_number', function ($orderReport) {
                return $orderReport->order_number;
            })
            ->addColumn('customer_name', function ($orderReport) {
                    if (is_numeric($orderReport->customer_id)) {
                        return optional($orderReport->customer)->first_name . ' ' . optional($orderReport->customer)->last_name;
                    }
                    return 'Walk-in Customer';
                })
                
                ->editColumn('created_at', function ($orderReport) {
                    return $orderReport->created_at ? \Carbon\Carbon::parse($orderReport->created_at)->format('d M, Y') : '-';
                })
                ->editColumn('discount', function ($orderReport) {
                    return $orderReport->discount_type === 'percent' ? $orderReport->discount . '%' : '$' . number_format($orderReport->discount, 2);
                })
                ->editColumn('total_before_discount', function ($orderReport) {
                    return '$' . number_format($orderReport->total_before_discount, 2);
                })
                ->editColumn('total_amount', function ($orderReport) {
                    return '$' . number_format($orderReport->total_amount, 2);
                })
                ->rawColumns(['order_number'])
                ->with('totalamount', $totalamount)
                ->make(true);
            }
            
        $customers = Customer::where('status', 1)->select('id', 'first_name', 'last_name')->get();

        return view('backends.reports.report', compact('customers'));
    }


    public function Reportdetail($id)
    {
        $report = Order::find($id);
        $items = OrderDetail::with('product')->where('order_id', $report->id)->get();
        return view('backends.reports.report_detail', compact('report', 'items'));
    }
}
