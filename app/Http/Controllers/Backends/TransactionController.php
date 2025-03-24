<?php

namespace App\Http\Controllers\Backends;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transactions = Transaction::with(['purchase', 'order', 'product']);
    
            if ($request->filled('transaction_type')) {
                $transactions->where('transaction_type', $request->transaction_type);
            }
    
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
                        ->orWhere('transaction_type', 'like', "%{$search}%")
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
    
            $totalamounttransaction = $transactions->sum('amount');

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
                ->with('totalamounttransaction', $totalamounttransaction) 
                ->make(true);
        }
    
        return view('backends.transaction.index');
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
