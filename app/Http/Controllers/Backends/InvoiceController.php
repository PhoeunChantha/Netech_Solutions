<?php

namespace App\Http\Controllers\Backends;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;

class InvoiceController extends Controller
{

    function index(Request $request)
    {
        $orderId = $request->query('order_id');
        $invoice = Order::with(['customer', 'orderdetails.product','user'])->findOrFail($orderId);
        $businessCollection = BusinessSetting::select('type', 'value')
            ->whereIn('type', ['company_name', 'company_address', 'phone', 'email'])
            ->pluck('value', 'type');
        
        $business = (object) $businessCollection->toArray();
    
        return view('backends.invoice.invoice', compact('invoice', 'business'));
    }
    
   
}
