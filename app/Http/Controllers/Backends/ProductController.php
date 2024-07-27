<?php

namespace App\Http\Controllers\Backends;

use File;
use Exception;
use App\Models\Product;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Http\Request;
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
        $categories = Category::pluck('name', 'id');
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.product.create', compact('categories', 'language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            // 'event' => 'required',
            // 'partner' => 'required',
            //  'discount' => 'nullable|numeric',
            'price' => 'required|numeric',
        ]);

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
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
            $product->category_id = $request->category;
            $product->price = $request->price;
            //  $product->discount_type = $request->discount_type;
            // $product->discount = $request->discount;
            $product->created_by = auth()->user()->id;

            if ($request->filled('image_names')) {
                $product->image = $request->image_names;
                $directory = public_path('uploads/products');
                if (!\File::exists($directory)) {
                    \File::makeDirectory($directory, 0777, true);
                }

                $image = File::move(public_path('uploads/temp/' . $request->image_names), public_path('uploads/products/' . $request->image_names));
            }

            $product->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
            Translation::insert($data);

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
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

        $product = Product::withoutGlobalScopes()->with('translations')->findOrFail($id);
        $categories = Category::pluck('name', 'id');

        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.product.edit', compact('product', 'categories', 'language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            // 'event' => 'required',
            'price' => 'required|numeric',
        ]);

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
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

            $product = Product::findOrFail($id);
            $product->name = $request->name[array_search('en', $request->lang)];
            $product->category_id = $request->category;
            $product->price = $request->price;

            if ($request->filled('image_names')) {
                $product->image = $request->image_names;
                $directory = public_path('uploads/products');
                if (!\File::exists($directory)) {
                    \File::makeDirectory($directory, 0777, true);
                }

                $image = \File::move(public_path('uploads/temp/' . $request->image_names), public_path('uploads/products/' . $request->image_names));
            }

            $product->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Product',
                            'translationable_id' => $product->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $request->name[$index]]
                    );
                }
            }
            Translation::insert($data);

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('updated successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
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
