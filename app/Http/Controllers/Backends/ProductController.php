<?php

namespace App\Http\Controllers\Backends;

use File;
use Exception;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest('id')->paginate(10);
        return view('backends.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with('category', 'brand')->get();
        $categories = Category::all();
        $brands = Brand::all();
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.product.create', compact('products', 'categories', 'brands', 'language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required|exists:brands,id',
            // 'operating' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
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
            $product->brand_id = $request->brand_id;
            // $product->operating_system = $request->operating;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->created_by = auth()->user()->id;
            if ($request->hasFile('thumbnail')) {
                $product->thumbnail = ImageManager::upload('uploads/products/', $request->thumbnail);
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

            $output = [
                'success' => 1,
                'msg' => ('Create successfully'),
            ];
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }
        return redirect()->route('admin.product.index')->with($output);
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
    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::withoutGlobalScopes()->with('translations')->with('category', 'brand')->findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.product.edit', compact('product', 'brands', 'categories', 'language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required|exists:brands,id',
            // 'operating' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        // dd($validator);

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
            // dd($request->all());
            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $product->name = $request->name[array_search('en', $request->lang)];
            $product->description = $request->description[array_search('en', $request->lang)];
            // $product->code = strtoupper(Str::random(5));
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            // $product->operating_system = $request->operating;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->created_by = auth()->user()->id;
            if ($request->hasFile('thumbnail')) {
                $oldImage = $product->thumbnail;
                $product->thumbnail = ImageManager::update('uploads/products/', $oldImage, $request->file('thumbnail'));
                // $brand->save();
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

            $output = [
                'success' => 1,
                'msg' => ('Create successfully'),
            ];
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }

        return redirect()->route('admin.product.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Product')
                ->where('translationable_id', $product->id);
            $translation->delete();
            $product->delete();

            $products = Product::latest('id')->paginate(10);
            $view = view('backends.product._table', compact('products'))->render();

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
