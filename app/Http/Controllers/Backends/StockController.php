<?php

namespace App\Http\Controllers\Backends;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Product::where('status', 1)->where('quantity', '>', 10)->with(['purchases', 'orderDetails'])
            ->latest('id')
            ->paginate(10)
            ->through(function ($product) {
                $totalPurchased = $product->purchases->sum('quantity');
                $totalOrdered = $product->orderDetails->sum('quantity');
                $stockAvailable = max($totalPurchased - $totalOrdered, 0); 
    
                return [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'total_purchased' => $totalPurchased,
                    'total_ordered' => $totalOrdered,
                    'stock_available' => $stockAvailable,
                ];
            });
    
        return view('backends.stock.index', compact('stocks'));
    }
    
}
