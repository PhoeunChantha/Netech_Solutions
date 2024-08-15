<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::latest('id')->paginate(10);
        return view('backends.product-category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.product-category._create', compact('language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'icon_image' => 'nullable',
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
            // dd($request->all());
            DB::beginTransaction();
            $category = new Category;
            $category->name = $request->name[array_search('en', $request->lang)];
            $category->slug = Str::slug($request->name[array_search('en', $request->lang)]);
            $category->created_by = auth()->user()->id;

            if ($request->hasFile('icon_image')) {
                $category->icon_images = ImageManager::upload('uploads/category/', $request->icon_image);
            }
            if ($request->hasFile('thumbnail')) {
                $category->thumbnails = ImageManager::upload('uploads/category/', $request->thumbnail);
            }

            $category->save();
            $data = [];
            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Category',
                        'translationable_id' => $category->id,
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
                'msg' => __('Create successfully'),
            ];
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }

        return redirect()->back()->with($output);
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
        // dd($id);
        $category = Category::withoutGlobalScopes()->with('translations')->findOrFail($id);

        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.product-category._edit', compact('category', 'language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'icon_image' => 'nullable',
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

            $category = Category::findOrFail($id);
            $category->name = $request->name[array_search('en', $request->lang)];
            $category->slug = Str::slug($request->name[array_search('en', $request->lang)]);
            // if ($request->hasFile('icon_image')) {
            //     $category->icon_images = ImageManager::update('uploads/category/', $category->icon_image, $request->icon_image);
            // }
            if ($request->hasFile('icon_image')) {
                $oldImage = $category->icon_image;
                $category->icon_images = ImageManager::update('uploads/category/', $oldImage, $request->file('icon_image'));
                // $brand->save();
            }
            if ($request->hasFile('thumbnail')) {
                $oldImage = $category->thumbnail;
                $category->thumbnails = ImageManager::update('uploads/category/', $oldImage, $request->file('thumbnail'));
                // $brand->save();
            }
            $category->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Category',
                            'translationable_id' => $category->id,
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
                'msg' => __('Create successfully'),
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }

        return redirect()->back()->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Category')
                ->where('translationable_id', $category->id);

            $translation->delete();
            $category->delete();

            $categories = Category::latest('id')->paginate(10);
            $view = view('backends.product-category._table', compact('categories'))->render();

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

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $category = Category::findOrFail($request->id);
            $category->status = $category->status == 1 ? 0 : 1;
            $category->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {

            $output = ['status' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
