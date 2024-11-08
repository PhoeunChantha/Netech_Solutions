<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::where('status', 1)->paginate(10);
        return view('backends.discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::with('products')->get();
        // $products = Product::pluck('name', 'id','brand_id');
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.discount.create', compact('brands', 'language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable',
            'description' => 'nullable',
            'product_id' => 'nullable|string',
            'discount_type' => 'nullable',
            'discount_value' => 'nullable',
            'quantity_limited' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
        ]);
        // dd($validator);

        // if (is_null($request->name[array_search('en', $request->lang)])) {
        //     $validator->after(function ($validator) {
        //         $validator->errors()->add(
        //             'name',
        //             'Name field is required!'
        //         );
        //     });
        // }
        // if (is_null($request->description[array_search('en', $request->lang)])) {
        //     $validator->after(function ($validator) {
        //         $validator->errors()->add(
        //             'description',
        //             'Description field is required!'
        //         );
        //     });
        // }

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput()
        //         ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        // }

        try {
            DB::beginTransaction();

            $discount = new Discount();
            $discount->name = $request->name[array_search('en', $request->lang)];
            $discount->description = $request->description[array_search('en', $request->lang)];
            $discount->product_ids = $request->product_id;
            $discount->discount_type = $request->discount_type;
            $discount->discount_value = $request->discount_value;
            $discount->quantity_limited = $request->quantity_limited;
            $discount->start_date = $request->start_date;
            $discount->end_date = $request->end_date;
            $discount->created_by = auth()->user()->id;
            if ($request->hasFile('images')) {
                $discount->image = ImageManager::upload('uploads/discounts/', $request->images);
            }

            $discount->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Discount',
                        'translationable_id' => $discount->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ];
                }
            }

            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Discount',
                        'translationable_id' => $discount->id,
                        'locale' => $key,
                        'key' => 'description',
                        'value' => $request->description[$index],
                    ];
                }
            }
            Translation::insert($data);
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => ('Create successfully'),
            ];
        } catch (Exception $e) {
            dd($e);
            // DB::rollBack();
            // $output = [
            //     'success' => 0,
            //     'msg' => __('Something went wrong'),
            // ];
        }
        return redirect()->route('admin.discount.index')->with($output);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $discount = Discount::findOrFail($request->id);
            $discount->status = $discount->status == 1 ? 0 : 1;
            $discount->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $output = ['status' => 0, 'msg' => __('Something went wrong')];
        }

        return response()->json($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
