<?php

namespace App\Http\Controllers\Backends;

use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Employee;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalorder = Order::count();
        $products = Product::where('status', 1)->get();
        $totalexpense = Transaction::where('transaction_type', 'expense')->sum('amount');
        $totalincome = Transaction::where('transaction_type', 'income')->sum('amount');
        $totalprofit = $totalincome - $totalexpense;
        return view('backends.index', compact('products', 'totalorder', 'totalincome', 'totalprofit', 'totalexpense'));
    }
    public function dashboardStats()
    {
        $totalorder = Order::count();
        $products = Product::where('status', 1)->count();
        $totalexpense = Transaction::where('transaction_type', 'expense')->sum('amount');
        $totalincome = Transaction::where('transaction_type', 'income')->sum('amount');
        $totalprofit = $totalincome - $totalexpense;

        // Get last month's data for comparison
        $lastMonthStart = now()->subMonth()->startOfMonth();
        $lastMonthEnd = now()->subMonth()->endOfMonth();

        $lastMonthOrders = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $lastMonthExpense = Transaction::where('transaction_type', 'expense')
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->sum('amount');
        $lastMonthIncome = Transaction::where('transaction_type', 'income')
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->sum('amount');
        $lastMonthProducts = Product::where('status', 1)
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->count();

        // Calculate trends
        $orderTrend = $lastMonthOrders > 0 ? round((($totalorder - $lastMonthOrders) / $lastMonthOrders) * 100, 1) : 0;
        $expenseTrend = $lastMonthExpense > 0 ? round((($totalexpense - $lastMonthExpense) / $lastMonthExpense) * 100, 1) : 0;
        $incomeTrend = $lastMonthIncome > 0 ? round((($totalincome - $lastMonthIncome) / $lastMonthIncome) * 100, 1) : 0;
        $productTrend = $lastMonthProducts > 0 ? round((($products - $lastMonthProducts) / $lastMonthProducts) * 100, 1) : 0;

        return response()->json([
            'totalorder' => $totalorder,
            'productsCount' => $products,
            'totalexpense' => number_format($totalexpense, 2, '.', ''),
            'totalincome' => number_format($totalincome, 2, '.', ''),
            'totalprofit' => number_format($totalprofit, 2, '.', ''),
            'orderTrend' => $orderTrend,
            'expenseTrend' => $expenseTrend,
            'incomeTrend' => $incomeTrend,
            'productTrend' => $productTrend,
        ]);
    }
    public function topProductsChart(Request $request)
    {
        $filter = $request->get('filter', 'this_month');

        $query = OrderDetail::query()
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->with('product');

        switch ($filter) {
            case 'today':
                $query->whereDate('created_at', today());
                break;

            case 'yesterday':
                $query->whereDate('created_at', today()->subDay());
                break;

            case 'this_week':
                $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
                break;

            case 'this_month':
                $query->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'));
                break;

            case 'this_year':
                $query->whereYear('created_at', date('Y'));
                break;
        }

        $topProducts = $query->orderBy('total_quantity', 'desc')->limit(5)->get();

        $labels = $topProducts->map(function ($orderDetail) {
            return $orderDetail->product->name;
        });

        $data = $topProducts->map(function ($orderDetail) {
            return $orderDetail->total_quantity;
        });

        $images = $topProducts->map(function ($orderDetail) {
            $thumbnails = $orderDetail->product->thumbnail;

            $image = is_array($thumbnails) && count($thumbnails) > 0
                ? asset('uploads/products/' . $thumbnails[0])
                : asset('uploads/products/default.png');

            return $image;
        });


        return response()->json([
            'labels' => $labels->toArray(),
            'data' => $data->toArray(),
            'images' => $images->toArray(),
        ]);
    }

    public function profitChart(Request $request)
    {
        $filter = $request->input('filter', 'this_month');

        $query = DB::table('transactions')
            ->selectRaw('DATE(transaction_date) as date')
            ->selectRaw("
                SUM(CASE WHEN transaction_type = 'income' THEN amount ELSE 0 END) as total_income,
                SUM(CASE WHEN transaction_type = 'expense' THEN amount ELSE 0 END) as total_expense
            ")
            ->groupBy('date')
            ->orderBy('date');

        if ($filter === 'today') {
            $query->whereDate('transaction_date', today());
        } elseif ($filter === 'yesterday') {
            $query->whereDate('transaction_date', today()->subDay());
        } elseif ($filter === 'this_week') {
            $query->whereBetween('transaction_date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        } elseif ($filter === 'this_month') {
            $query->whereMonth('transaction_date', now()->month)
                ->whereYear('transaction_date', now()->year);
        } elseif ($filter === 'this_year') {
            $query->whereYear('transaction_date', now()->year);
        }

        $profits = $query->get();

        $labels = [];
        $data = [];

        foreach ($profits as $profit) {
            $labels[] = $profit->date;
            $data[] = $profit->total_income - $profit->total_expense;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
