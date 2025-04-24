<?php

namespace App\Http\Controllers\Backends;

use Exception;
use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\Translation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PurchaseDetail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $purchases = Purchase::with(['supplier', 'product', 'createdBy']);

            if ($request->filled('supplier_name')) {
                $purchases->whereHas('supplier', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->supplier_name . '%');
                });
            }


            if ($request->filled('date_range')) {
                $dates = explode(' - ', $request->date_range);

                if (count($dates) == 2) {
                    $date_from = Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
                    $date_to = Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();

                    $purchases->whereBetween('created_at', [$date_from, $date_to]);
                }
            }

            if ($request->filled('purchase_status')) {
                $purchases->where('purchase_status', $request->purchase_status);
            }
            if ($request->filled('payment_status')) {
                $purchases->where('payment_status', $request->payment_status);
            }


            if ($request->filled('search_value')) {
                $search = $request->input('search_value');
                $purchases->where(function ($query) use ($search) {
                    $query->where('purchase_date', 'like', "%{$search}%")
                        ->orWhere('purchase_status', 'like', "%{$search}%")
                        ->orWhere('payment_status', 'like', "%{$search}%")
                        ->orWhere('payment_date', 'like', "%{$search}%")
                        ->orWhereHas('supplier', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('product', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $totalpurchase = $purchases->sum('total_cost');
            $totalpurchasedue = $purchases->sum('payment_due');
            $totalpurchasepaid = $purchases->sum('dollar_amount');


            return datatables()->eloquent($purchases)
                ->addColumn('actions', function ($purchase) {
                    return view('backends.purchase.action', compact('purchase'))->render();
                })
                ->editColumn('supplier.name', function ($purchase) {
                    return optional($purchase->supplier)->name ?? '-';
                })
                ->editColumn('total_cost', function ($purchase) {
                    return '$' . number_format($purchase->total_cost, 2);
                })
                ->editColumn('purchase_date', function ($purchase) {
                    return $purchase->purchase_date ? \Carbon\Carbon::parse($purchase->purchase_date)->format('d M, Y') : '-';
                })
                ->editColumn('payment_status', function ($purchase) {
                    return $purchase->payment_due > 0
                        ? '<span class="badge badge-warning">Due</span>'
                        : '<span class="badge badge-success">Paid</span>';
                })

                ->editColumn('dollar_amount', function ($purchase) {
                    return $purchase->payment_method == 'cash'
                        ? '$' . number_format($purchase->dollar_amount, 2)
                        : '-';
                })
                ->editColumn('payment_due', function ($purchase) {
                    return $purchase->payment_due > 0
                        ? '$' . number_format($purchase->payment_due, 2)
                        : '-';
                })
                ->editColumn('purchase_status', function ($purchase) {
                    return view('backends.purchase.status', compact('purchase'))->render();
                })
                ->editColumn('createdBy.name', function ($purchase) {
                    return optional($purchase->createdBy)->name ?? '-';
                })
                ->rawColumns(['actions', 'purchase_status', 'payment_status'])
                ->with('totalpurchase', $totalpurchase)
                ->with('totalpurchasedue', $totalpurchasedue)
                ->with('totalpurchasepaid', $totalpurchasepaid)
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
        // $products = Product::where('status', 1)->get();

        $products = Product::with('category', 'brand')->where('status', 1)->get();
        $categories = Category::all();
        $brands = Brand::all();
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.purchase.create', compact('products', 'suppliers', 'categories', 'brands', 'language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'products' => 'required|array',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.sell_price' => 'required|numeric|min:0',
            'dollar_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
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
            $purchase->purchase_date = $request->purchase_date;
            $purchase->description = $request->description;
            $purchase->purchase_status = $request->status;
            $purchase->total_cost = 0;
            $purchase->created_by = auth()->user()->id;
            $purchase->payment_method = $request->payment_method;
            $purchase->dollar_amount = $request->dollar_amount;
            $purchase->riel_amount = $request->riel_amount;
            $purchase->payment_due = $request->payment_due;
            if ($request->payment_due > 0) {
                $purchase->payment_status = 'Due';
            } else {
                $purchase->payment_status = 'Paid';
            }
            $purchase->payment_note = $request->payment_note;
            $purchase->bank_no = $request->bank_account;

            $purchase->save();

            $totalCost = 0;

            foreach ($request->products as $productId => $productData) {
                $quantity = (float) ($productData['quantity'] ?? 0);
                $purchasePrice = (float) ($productData['price'] ?? 0);
                $sellPrice = (float) ($productData['sell_price'] ?? 0);

                if ($quantity <= 0 || $purchasePrice <= 0) continue;

                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $purchasePrice,
                    'sell_price' => $sellPrice,
                ]);

                $totalCost += $quantity * $purchasePrice;

                // Update product stock
                if ($request->status == 'Recieved') {
                    $product = Product::find($productId);

                    if ($product) {
                        $product->quantity += $quantity;
                        $product->price = $sellPrice;
                        $product->default_purchase_price = $purchasePrice;
                        $product->save();

                        Transaction::create([
                            'transaction_type' => 'expense',
                            'purchase_id' => $purchase->id,
                            'product_id' => $productId,
                            'quantity' => $quantity,
                            'amount' => $quantity * $purchasePrice,
                            'transaction_date' => now(),
                            'description' => 'Purchase of ' . $quantity . ' units',
                        ]);
                    }
                }
            }

            $purchase->total_cost = $totalCost;
            $purchase->save();

            DB::commit();

            return redirect()->route('admin.purchases.index')->with([
                'success' => 1,
                'msg' => 'Created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'success' => 0,
                'msg' => 'Something went wrong',
            ]);
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());
        }
    }


    public function productstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
                );
            });
        }
        if (is_null($request->description[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'description',
                    'Description field is required!'
                );
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $product = new Product;
            $product->name = $request->name[array_search('en', $request->lang)];
            $product->description = $request->description[array_search('en', $request->lang)];
            $product->code = strtoupper(Str::random(5));
            $product->category_id = $request->category_id;
            $product->specification = $request->specification;
            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->created_by = auth()->user()->id;
            if ($request->hasFile('thumbnail')) {
                $uploadedThumbnails = [];
                foreach ($request->file('thumbnail') as $file) {
                    $uploadedThumbnails[] = ImageManager::upload('uploads/products/', $file);
                }
                $product->thumbnail = $uploadedThumbnails;
            }

            $product->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ];
                }
            }

            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'description',
                        'value' => $request->description[$index],
                    ];
                }
            }

            Translation::insert($data);
            DB::commit();

            return response()->json([
                'success' => 1,
                'msg' => 'Create successfully',
                'product' => $product
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => 0,
                'msg' => 'Something went wrong'
            ]);
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function purchase_Detail($id)
    {
        $purchase = Purchase::with('supplier')->findOrFail($id);
        $details = PurchaseDetail::with('product')->where('purchase_id', $purchase->id)->get();
        return view('backends.purchase.purchase_detail', compact('purchase', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::where('status', 1)->get();
        $purchase = Purchase::with('purchaseDetails')->findOrFail($id);
        $suppliers = Supplier::pluck('name', 'id');
        return view('backends.purchase.edit', compact('purchase', 'suppliers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'products' => 'required|array',
            'products.*.price' => 'required',
            'products.*.sell_price' => 'required',
            'dollar_amount' => 'required',
            'payment_method' => 'required|string',
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput()
        //         ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        // }

        try {
            DB::beginTransaction();
            
            $purchase = Purchase::findOrFail($id);
            $purchase->supplier_id = $request->supplier_id;
            $purchase->purchase_date = $request->purchase_date;
            $purchase->description = $request->description;
            $purchase->purchase_status = $request->status;
            $purchase->payment_method = $request->payment_method;
            $purchase->dollar_amount = $request->dollar_amount;
            $purchase->riel_amount = $request->riel_amount;
            $purchase->payment_due = $request->payment_due;
            if ($request->payment_due > 0) {
                $purchase->payment_status = 'Due';
            } else {
                $purchase->payment_status = 'Paid';
            }
            $purchase->payment_note = $request->payment_note;
            $purchase->bank_no = $request->bank_account;
            $purchase->total_cost = 0;
            $purchase->created_by = auth()->user()->id;


            $purchase->save();

            $totalCost = 0;
            foreach ($request->products as $productId => $productData) {
                $quantity = (float) ($productData['quantity'] ?? 0);
                $purchasePrice = (float) ($productData['price'] ?? 0);
                $sellPrice = (float) ($productData['sell_price'] ?? 0);
            
                if ($quantity <= 0 || $purchasePrice <= 0) continue;
            
                $purchaseDetail = PurchaseDetail::where('purchase_id', $purchase->id)
                    ->where('product_id', $productId)
                    ->first(); 
            
                if ($purchaseDetail) {
                    $purchaseDetail->quantity = $quantity;
                    $purchaseDetail->price = $purchasePrice;
                    $purchaseDetail->sell_price = $sellPrice;
                    $purchaseDetail->save();
                } else {
                    PurchaseDetail::create([
                        'purchase_id' => $purchase->id,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'price' => $purchasePrice,
                        'sell_price' => $sellPrice,
                    ]);
                }
            
                $totalCost += $quantity * $purchasePrice;
              
                if ($request->status == 'Recieved') {
                    $product = Product::find($productId);
                    if ($product) {
                        $product->quantity += $quantity;  
                        $product->price = $sellPrice; 
                        $product->default_purchase_price = $purchasePrice; 
                        $product->save();
            
                        Transaction::create([
                            'transaction_type' => 'expense', 
                            'purchase_id' => $purchase->id,
                            'product_id' => $productId,
                            'quantity' => $quantity,
                            'amount' => $quantity * $purchasePrice,
                            'transaction_date' => now(),
                            'description' => 'Purchase of ' . $quantity . ' units',
                        ]);
                    }
                }
            }
            

            $purchase->total_cost = $totalCost;
            $purchase->save();

            DB::commit();

            return redirect()->route('admin.purchases.index')->with([
                'success' => 1,
                'msg' => 'Updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());
            return redirect()->back()->with([
                'success' => 0,
                'msg' => 'Something went wrong',
            ]);
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
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'msg' => __('Something went wrong.')
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $purchase = Purchase::findOrFail($request->id);

            $purchase->purchase_status = $request->status;
            $purchase->save();

            if ($purchase->purchase_status == 'Recieved') {
                $details = PurchaseDetail::where('purchase_id', $purchase->id)->get();
                foreach ($details as $detail) {
                    $product = Product::findOrFail($detail->product_id);
                    $product->quantity += $detail->quantity;
                    $product->price = $detail->sell_price;
                    $product->save();
                }
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
