<?php

namespace App\Http\Controllers\Backends;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    
    public function index()
    {
        $stocks = Product::with('orderDetails')
        ->where('status', 1)
        ->where('quantity', '<', 10)
        ->latest('id')
        ->get()
        ->map(function ($product) {
            $totalOrdered = $product->orderDetails->sum('quantity');
            return [
                'code' => $product->code,
                'product_name' => $product->name,
                'total_ordered' => $totalOrdered,
                'stock_available' => $product->quantity,
            ];
        });

        return view('backends.stock.index', compact('stocks'));
    }
}
