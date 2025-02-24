<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::query();
    
        // ✅ Filter by Transaction Type (Income or Expense)
        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }
    
        // ✅ Filter by Date Range
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('transaction_date', [$request->date_from, $request->date_to]);
        }
    
        // ✅ Filter by Product Name
        if ($request->filled('product_name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->product_name . '%');
            });
        }
    
        // ✅ Filter by Customer Name
        if ($request->filled('customer_name')) {
            $query->whereHas('order.customer', function ($q) use ($request) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $request->customer_name . '%']);
            });
        }
    
        // ✅ Filter by Supplier Name
        if ($request->filled('supplier_name')) {
            $query->whereHas('purchase.supplier', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->supplier_name . '%');
            });
        }
    
        // ✅ Filter by Payment Method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }
    
        // ✅ Filter by Amount Range
        if ($request->filled('min_amount') && $request->filled('max_amount')) {
            $query->whereBetween('amount', [$request->min_amount, $request->max_amount]);
        }
    
        $transactions = $query->latest('id')->paginate(10);
    
        return view('backends.transaction.index', compact('transactions'));
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
