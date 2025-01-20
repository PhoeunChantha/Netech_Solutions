<?php

namespace App\Http\Controllers\Backends;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    //
    function index(Request $request)
    {
        $orderId = $request->query('order_id');
        $invoice = Order::with(['user', 'orderdetails'])->findOrFail($orderId);

        return view('backends.invoice.invoice', compact('invoice'));
    }
}
