<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
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

            if ($request->filled('date_from') && $request->filled('date_to')) {
                $transactions->whereBetween('transaction_date', [$request->date_from, $request->date_to]);
            } elseif ($request->filled('date_from') && !$request->filled('date_to')) {
                $transactions->whereDate('transaction_date', '>=', $request->date_from);
            } elseif ($request->filled('date_to') && !$request->filled('date_from')) {
                $transactions->whereDate('transaction_date', '<=', $request->date_to);
            }

            if ($request->filled('product_name')) {
                $transactions->whereHas('product', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->product_name . '%');
                });
            }

            if ($request->filled('transaction_amount_range')) {
                [$min, $max] = explode('-', $request->transaction_amount_range);
                if ($max === '') {
                    $transactions->where('amount', '>=', $min);
                } else {
                    $transactions->whereBetween('amount', [$min, $max]);
                }
            }

            if ($request->filled('search_value')) {
                $search = $request->search_value;
                $transactions->where(function ($query) use ($search) {
                    $query->where('description', 'like', "%{$search}%")
                        ->orWhere('transaction_date', 'like', "%{$search}%")
                        ->orWhere('transaction_type', 'like', "%{$search}%")
                        ->orWhere('amount', 'like', "%{$search}%")
                        ->orWhere('quantity', 'like', "%{$search}%")
                        ->orWhereHas('product', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $totalAmountTransaction = $transactions->sum('amount');

            return datatables()->eloquent($transactions)
                ->addColumn('product_name', function ($transaction) {
                    return optional($transaction->product)->name ?? '-';
                })
                ->editColumn('amount', function ($transaction) {
                    return '$' . number_format($transaction->amount, 2);
                })
                ->editColumn('transaction_date', function ($transaction) {
                    return $transaction->transaction_date ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d M, Y') : '-';
                })
                ->addColumn('description', function ($transaction) {
                    return $transaction->description;
                })
                ->with('totalamounttransaction', $totalAmountTransaction)
                ->make(true);
        }

        return view('backends.transaction.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::pluck('name', 'id');
        $products = Product::where('status', 1)->get();
        return view('backends.purchase.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'status' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $purchase = new Purchase();
            $purchase->supplier_id = $request->supplier_id;
            $purchase->product_id = $request->product_id;
            $purchase->quantity = $request->quantity;
            $purchase->unit_cost = $request->unit_cost;
            $purchase->total_cost = $request->total_cost;
            $purchase->purchase_date = $request->purchase_date;
            $purchase->purchase_status = $request->status;
            $purchase->description = $request->description;
            $purchase->created_by = auth()->user()->id;

            $purchase->save();

            $transaction = new Transaction();
            $transaction->transaction_type = 'expense';
            $transaction->purchase_id = $purchase->id;
            $transaction->product_id = $request->product_id;
            $transaction->amount = $purchase->total_cost;
            $transaction->quantity = $purchase->quantity;
            $transaction->transaction_date = now();
            $transaction->description = 'Purchase of ' . $purchase->quantity . ' units';
            $transaction->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => ('Create successfully'),
            ];
            return redirect()->route('admin.purchases.index')->with($output);
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $suppliers = Supplier::pluck('name', 'id');
        $products = Product::where('status', 1)->get();
        return view('backends.purchase.edit', compact('purchase', 'suppliers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'status' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }
        try {
            DB::beginTransaction();
            $purchase = Purchase::findOrFail($id);
            $purchase->supplier_id = $request->supplier_id;
            $purchase->product_id = $request->product_id;
            $purchase->quantity = $request->quantity;
            $purchase->unit_cost = $request->unit_cost;
            $purchase->total_cost = $request->total_cost;
            $purchase->purchase_date = $request->purchase_date;
            $purchase->purchase_status = $request->status;

            $purchase->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => ('Create successfully'),
            ];
            return redirect()->route('admin.purchases.index')->with($output);
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $purchase = Purchase::findOrFail($id);
            $transactionExists = Transaction::where('purchase_id', $purchase->id)->exists();

            if ($transactionExists) {
                return response()->json([
                    'status' => 0,
                    'msg' => __('This purchase has an existing transaction and cannot be deleted.')
                ]);
            }

            $purchase->delete();

            $purchases = Purchase::latest('id')->paginate(10);
            $view = view('backends.purchase._table', compact('purchases'))->render();

            DB::commit();

            return response()->json([
                'status' => 1,
                'view' => $view,
                'msg' => __('Deleted successfully')
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error("Purchase Deletion Error: " . $e->getMessage());

            return response()->json([
                'status' => 0,
                'msg' => __('Something went wrong while deleting the purchase. Please try again.')
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $purchase = Purchase::findOrFail($request->id);

            $purchase->purchase_status = $request->status;
            $purchase->save();
            if ($purchase->purchase_status == 'Completed') {
                $product = Product::findOrFail($purchase->product_id);
                $product->quantity += $purchase->quantity;
                $product->save();
            } else if ($purchase->purchase_status == 'Pending') {
                $product = Product::findOrFail($purchase->product_id);
                $product->quantity -= $purchase->quantity;
                $product->save();
            }

            DB::commit();

            $output = ['status' => 1, 'msg' => __('Status updated successfully')];
            Log::info("✅ Purchase ID {$purchase->id} status updated to {$request->status}");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("❌ Error updating status for Purchase ID {$request->id}: " . $e->getMessage());

            $output = ['status' => 0, 'msg' => __('Something went wrong. Please try again.')];
        }

        return response()->json($output);
    }
}
