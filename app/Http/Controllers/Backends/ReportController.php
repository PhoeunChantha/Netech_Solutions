<?php

namespace App\Http\Controllers\Backends;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $orderReport = Order::with('orderdetails', 'customer')->orderBy('created_at', 'desc');

            if ($request->filled('customer_id')) {
                $orderReport->where('customer_id', $request->customer_id);
            }
            if ($request->filled('payment_status')) {
                $orderReport->where('payment_status', $request->payment_status);
            }
            if ($request->filled('payment_method')) {
                $orderReport->where('payment_method', $request->payment_method);
            }

            if ($request->filled('order_date')) {
                $orderReport->whereDate('created_at', $request->order_date);
            }

            if ($request->filled('date_range')) {
                $dates = explode(' - ', $request->date_range);
            
                if (count($dates) == 2) {
                    $date_from = Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
                    $date_to = Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();  
            
                    $orderReport->whereBetween('created_at', [$date_from, $date_to]);
                }
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
                ->addColumn('action', function ($orderReport) {
                    return view('backends.reports.action', compact('orderReport'))->render();
                })
                
                ->editColumn('created_at', function ($orderReport) {
                    return $orderReport->created_at ? \Carbon\Carbon::parse($orderReport->created_at)->format('d M, Y') : '-';
                })
                ->editColumn('discount', function ($orderReport) {
                    return $orderReport->discount_type === 'percent' ? $orderReport->discount . '%' : '$' . number_format($orderReport->discount, 2);
                })
               
                ->editColumn('payment_status', function ($orderReport) {
                    return $orderReport->payment_status === 'due'
                        ? '<span class="badge badge-warning">Due</span>'
                        : '<span class="badge badge-success">Paid</span>';
                })
                ->editColumn('payment_method', function ($orderReport) {
                    return $orderReport->payment_method;
                })
                ->editColumn('order_quantity', function ($orderReport) {
                   return $orderReport->orderdetails->count();
                })
                ->editColumn('total_before_discount', function ($orderReport) {
                    return '$' . number_format($orderReport->total_before_discount, 2);
                })
                ->editColumn('total_amount', function ($orderReport) {
                    return '$' . number_format($orderReport->total_amount, 2);
                })
                ->rawColumns(['order_number','payment_status','action'])
                ->with('totalamount', $totalamount)
                ->make(true);
            }
            
        $customers = Customer::where('status', 1)->select('id', 'first_name', 'last_name')->get();

        return view('backends.reports.report', compact('customers'));
    }

    public function expense(Request $request)
    {

        if ($request->ajax()) {
            $transactions = Transaction::where('transaction_type', 'expense')->with(['purchase', 'order', 'product']);
    
            if ($request->filled('date_range')) {
                $dates = explode(' - ', $request->date_range);
            
                if (count($dates) == 2) {
                    $date_from = Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
                    $date_to = Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();  
            
                    $transactions->whereBetween('created_at', [$date_from, $date_to]);
                }
            }
    
            if ($request->filled('product_name')) {
                $transactions->whereHas('product', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->product_name . '%');
                });
            }
    
            if ($request->filled('customer_name')) {
                $transactions->whereHas('order.customer', function ($q) use ($request) {
                    $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $request->customer_name . '%']);
                });
            }
    
            if ($request->filled('supplier_name')) {
                $transactions->whereHas('purchase.supplier', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->supplier_name . '%');
                });
            }
    
            if ($request->filled('payment_method')) {
                $transactions->where('payment_method', $request->payment_method);
            }
    
            if ($request->filled('min_amount') && $request->filled('max_amount')) {
                $transactions->whereBetween('amount', [$request->min_amount, $request->max_amount]);
            }
            if ($request->filled('transaction_amount_range')) {
                $amountRange = explode('-', $request->transaction_amount_range);
                if (count($amountRange) == 2) {
                    $transactions->whereBetween('amount', [$amountRange[0], $amountRange[1]]);
                } else {
                    $transactions->where('amount', '>=', $amountRange[0]);
                }
            }
    
            if (!empty($request->search_value)) {
                $search = $request->search_value;
                $transactions->where(function ($query) use ($search) {
                    $query->where('transaction_date', 'like', "%{$search}%")
                        ->orWhere('amount', 'like', "%{$search}%")
                        ->orWhere('quantity', 'like', "%{$search}%");
                        // ->orWhereHas('supplier', function ($q) use ($search) {
                        //     $q->where('name', 'like', "%{$search}%");
                        // })
                        // ->orWhereHas('product', function ($q) use ($search) {
                        //     $q->where('name', 'like', "%{$search}%");
                        // })
                        // ->orWhereHas('order.customer', function ($q) use ($search) {
                        //     $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%']);
                        // });
                });
            }
    
            $totalexpense = $transactions->sum('amount');

            return datatables()->eloquent($transactions)
                ->addColumn('transaction_type', function ($transaction) {
                    return $transaction->transaction_type;
                })
                ->addColumn('product_name', function ($transaction) {
                    return optional($transaction->product)->name;
                })
                ->editColumn('amount', function ($transaction) {
                    return '$' . number_format($transaction->amount, 2);
                })
                ->addColumn('quantity', function ($transaction) {
                    return $transaction->quantity;
                })
                ->editColumn('transaction_date', function ($transaction) {
                    return $transaction->transaction_date ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d M, Y') : '-';
                })
                ->addColumn('description', function ($transaction) {
                    return $transaction->description;
                })
                ->with('totalexpense', $totalexpense) 
                ->make(true);
        }
    
        return view('backends.reports.expense_report.index');
    }
    public function income(Request $request)
    {

        if ($request->ajax()) {
            $transactions = Transaction::where('transaction_type', 'income')->with(['purchase', 'order', 'product']);
    
            if ($request->filled('date_range')) {
                $dates = explode(' - ', $request->date_range);
            
                if (count($dates) == 2) {
                    $date_from = Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
                    $date_to = Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();  
            
                    $transactions->whereBetween('created_at', [$date_from, $date_to]);
                }
            }
    
            if ($request->filled('product_name')) {
                $transactions->whereHas('product', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->product_name . '%');
                });
            }
    
            if ($request->filled('customer_name')) {
                $transactions->whereHas('order.customer', function ($q) use ($request) {
                    $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $request->customer_name . '%']);
                });
            }
    
            if ($request->filled('supplier_name')) {
                $transactions->whereHas('purchase.supplier', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->supplier_name . '%');
                });
            }
    
            if ($request->filled('payment_method')) {
                $transactions->where('payment_method', $request->payment_method);
            }
    
            if ($request->filled('min_amount') && $request->filled('max_amount')) {
                $transactions->whereBetween('amount', [$request->min_amount, $request->max_amount]);
            }
            if ($request->filled('transaction_amount_range')) {
                $amountRange = explode('-', $request->transaction_amount_range);
                if (count($amountRange) == 2) {
                    $transactions->whereBetween('amount', [$amountRange[0], $amountRange[1]]);
                } else {
                    $transactions->where('amount', '>=', $amountRange[0]);
                }
            }
    
            if (!empty($request->search_value)) {
                $search = $request->search_value;
                $transactions->where(function ($query) use ($search) {
                    $query->where('transaction_date', 'like', "%{$search}%")
                        ->orWhere('amount', 'like', "%{$search}%")
                        ->orWhere('quantity', 'like', "%{$search}%");
                        // ->orWhereHas('supplier', function ($q) use ($search) {
                        //     $q->where('name', 'like', "%{$search}%");
                        // })
                        // ->orWhereHas('product', function ($q) use ($search) {
                        //     $q->where('name', 'like', "%{$search}%");
                        // })
                        // ->orWhereHas('order.customer', function ($q) use ($search) {
                        //     $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%']);
                        // });
                });
            }
    
            $totalincome = $transactions->sum('amount');

            return datatables()->eloquent($transactions)
                ->addColumn('transaction_type', function ($transaction) {
                    return $transaction->transaction_type;
                })
                ->addColumn('product_name', function ($transaction) {
                    return optional($transaction->product)->name;
                })
                ->editColumn('amount', function ($transaction) {
                    return '$' . number_format($transaction->amount, 2);
                })
                ->addColumn('quantity', function ($transaction) {
                    return $transaction->quantity;
                })
                ->editColumn('transaction_date', function ($transaction) {
                    return $transaction->transaction_date ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d M, Y') : '-';
                })
                ->addColumn('description', function ($transaction) {
                    return $transaction->description;
                })
                ->with('totalincome', $totalincome) 
                ->make(true);
        }
    
        return view('backends.reports.income_report.index');
    }


    public function Reportdetail($id)
    {
        $report = Order::with('customer')->find($id);
        $items = OrderDetail::with('product')->where('order_id', $report->id)->get();
        return view('backends.reports.report_detail', compact('report', 'items'));
    }

    /**
     * printReport
     */
    
    public function printReport(Request $request, $id){
        $orderId = $request->id;
        $invoice = Order::with(['customer', 'orderdetails.product','user'])->findOrFail($orderId);
        $businessCollection = BusinessSetting::select('type', 'value')
            ->whereIn('type', ['company_name', 'company_address', 'phone', 'email'])
            ->pluck('value', 'type');
        
        $business = (object) $businessCollection->toArray();
    
        return view('backends.invoice.invoice', compact('invoice', 'business'));
    }
    
     /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $report = Order::findOrFail($id);
            $orderDetails = OrderDetail::where('order_id', $report->id)->get();

            foreach ($orderDetails as $orderDetail) {
                $orderDetail->delete();
            }
            $report->delete();
            DB::commit();
            return response()->json([
                'status' => 1,
                'msg' => __('Deleted successfully')
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error("Purchase Deletion Error: " . $e->getMessage());
            return response()->json([
                'status' => 0,
                'msg' => __('Something went wrong')
            ], 500);
        }
    }
}
