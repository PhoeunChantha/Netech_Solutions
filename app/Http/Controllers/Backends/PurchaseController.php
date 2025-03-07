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
            $purchases = Purchase::with(['supplier', 'product']);

            if ($request->filled('supplier_name')) {
                $purchases->whereHas('supplier', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->supplier_name . '%');
                });
            }

            if ($request->filled('product_name')) {
                $purchases->whereHas('product', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->product_name . '%');
                });
            }

            if ($request->filled('purchase_date')) {
                $purchases->whereDate('purchase_date', $request->purchase_date);
            }

            if ($request->filled('date_from') && $request->filled('date_to')) {
                $purchases->whereBetween('purchase_date', [$request->date_from, $request->date_to]);
            } elseif ($request->filled('date_from')) {
                $purchases->whereDate('purchase_date', '>=', $request->date_from);
            } elseif ($request->filled('date_to')) {
                $purchases->whereDate('purchase_date', '<=', $request->date_to);
            }

            if ($request->filled('purchase_status')) {
                $purchases->where('purchase_status', $request->purchase_status);
            }

            if ($request->filled('search_value')) {
                $search = $request->search_value;
                $purchases->where(function ($query) use ($search) {
                    $query->where('purchase_date', 'like', "%{$search}%")
                        ->orWhere('purchase_status', 'like', "%{$search}%")
                        ->orWhereHas('supplier', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('product', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $totalpurchase = $purchases->sum('total_cost');

            return datatables()->eloquent($purchases)
                ->addColumn('actions', function ($purchase) {
                    return view('backends.purchase.action', compact('purchase'))->render();
                })
                ->editColumn('supplier.name', function ($purchase) {
                    return optional($purchase->supplier)->name ?? '-';
                })
                ->editColumn('product.name', function ($purchase) {
                    return optional($purchase->product)->name ?? '-';
                })
                ->editColumn('quantity', function ($purchase) {
                    return number_format($purchase->quantity, 2);
                })
                ->editColumn('unit_cost', function ($purchase) {
                    return '$' . number_format($purchase->unit_cost, 2);
                })
                ->editColumn('total_cost', function ($purchase) {
                    return '$' . number_format($purchase->total_cost, 2);
                })
                ->editColumn('purchase_date', function ($purchase) {
                    return $purchase->purchase_date ? \Carbon\Carbon::parse($purchase->purchase_date)->format('d M, Y') : '-';
                })
                ->editColumn('purchase_status', function ($purchase) {
                    return view('backends.purchase.status', compact('purchase'))->render();
                })
                ->rawColumns(['actions', 'purchase_status'])
                ->with('totalpurchase', $totalpurchase) 
                ->make(true);
        }

        return view('backends.purchase.index');
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
