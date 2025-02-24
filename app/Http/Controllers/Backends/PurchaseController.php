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

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Purchase::with('supplier', 'product');

        // ✅ Filter by Supplier Name
        if ($request->has('supplier_name') && $request->supplier_name != '') {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->supplier_name . '%');
            });
        }

        // ✅ Filter by Product Name
        if ($request->has('product_name') && $request->product_name != '') {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->product_name . '%');
            });
        }

        // ✅ Filter by Purchase Date
        if ($request->has('purchase_date') && $request->purchase_date != '') {
            $query->whereDate('purchase_date', $request->purchase_date);
        }

        // ✅ Filter by Date Range
        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('purchase_date', [$request->date_from, $request->date_to]);
        }

        // ✅ Filter by Quantity Range
        if ($request->has('min_quantity') && $request->has('max_quantity')) {
            $query->whereBetween('quantity', [$request->min_quantity, $request->max_quantity]);
        }

        // ✅ Filter by Unit Cost Range
        if ($request->has('min_unit_cost') && $request->has('max_unit_cost')) {
            $query->whereBetween('unit_cost', [$request->min_unit_cost, $request->max_unit_cost]);
        }

        // ✅ Filter by Total Cost Range
        if ($request->has('min_total_cost') && $request->has('max_total_cost')) {
            $query->whereBetween('total_cost', [$request->min_total_cost, $request->max_total_cost]);
        }

        // ✅ Filter by Purchase Status
        if ($request->has('purchase_status') && $request->purchase_status != '') {
            $query->where('status', $request->purchase_status);
        }

        // ✅ Get filtered purchases with pagination
        $purchases = $query->latest('id')->paginate(10);

        return view('backends.purchase.index', compact('purchases'));
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
