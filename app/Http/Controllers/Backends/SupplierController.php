<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest('id')->paginate(10);
        return view('backends.supplyer.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.supplyer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'contact' => 'required|string',
           
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->contact = $request->contact;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
        
            $supplier->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => ('Create successfully'),
            ];
            return redirect()->route('admin.supplier.index')->with($output);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backends.supplyer.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'contact' => 'required|string',
           
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }
        try {
            DB::beginTransaction();
            $supplier = Supplier::findOrFail($id);
            $supplier->name = $request->name;
            $supplier->contact = $request->contact;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => ('Updated successfully'),
            ];
            return redirect()->route('admin.supplier.index')->with($output);
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
            $supplier = Supplier::findOrFail($id);
            $purchaseExists = Purchase::where('supplier_id', $supplier->id)->exists();

            if ($purchaseExists) {
                return response()->json([
                    'status' => 0,
                    'msg' => __('This supplier has an existing purchase and cannot be deleted.')
                ]);
            }

            $supplier->delete();

            $supplier = Supplier::latest('id')->paginate(10);
            $view = view('backends.supplyer._table', compact('supplier'))->render();

            DB::commit();
            $output = [
                'status' => 1,
                'view' => $view,
                'msg' => __('Deleted successfully')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'status' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return response()->json($output);
    }
}
