<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Brand;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest('id')->paginate(10);
        return view('backends.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('brand.create')) {
            abort(403);
        }
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.brand.create', compact('language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048'
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
                ->with(['success' => 0, 'msg' => ('Invalid form input')]);
        }
        try {
            DB::beginTransaction();
            $brand = new Brand;
            $brand->name = $request->name[array_search('en', $request->lang)];
            $brand->description = $request->description[array_search('en', $request->lang)];
            if ($request->hasFile('thumbnail')) {
                $brand->thumbnail = ImageManager::upload('uploads/brands/', $request->thumbnail);
            }
            $brand->save();
            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Brand',
                        'translationable_id' => $brand->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Brand',
                        'translationable_id' => $brand->id,
                        'locale' => $key,
                        'key' => 'description',
                        'value' => $request->description[$index],
                    ));
                }
            }
            Translation::insert($data);

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => ('Create successfully'),
            ];
        } catch (Exception $e) {
          
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());

        }
        return redirect()->route('admin.brand.index')->with($output);
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
        if (!Gate::allows('brand.edit')) {
            abort(403);
        }
        $brand = Brand::withoutGlobalScopes()->with('translations')->findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.brand.edit', compact('brand', 'language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
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
      
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => ('Invalid form input')]);
        }
        try {
            DB::beginTransaction();
            $brand =  Brand::findOrFail($id);
            $brand->name = $request->name[array_search('en', $request->lang)];
            $brand->description = $request->description[array_search('en', $request->lang)];
            if ($request->hasFile('thumbnail')) {
                $oldImage = $brand->thumbnail;
                $brand->thumbnail = ImageManager::update('uploads/brands/', $oldImage, $request->file('thumbnail'));
                // $brand->save();
            }

            $brand->save();
            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Brand',
                        'translationable_id' => $brand->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Brand',
                        'translationable_id' => $brand->id,
                        'locale' => $key,
                        'key' => 'description',
                        'value' => $request->description[$index],
                    ));
                }
            }
            Translation::insert($data);

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => ('Create successfully'),
            ];
        } catch (Exception $e) {
           
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());

        }
        return redirect()->route('admin.brand.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $brand = Brand::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Brand')
                ->where('translationable_id', $brand->id);

            $translation->delete();
            $brand->delete();

            $brands = Brand::latest('id')->paginate(10);
            $view = view('backends.brand._table', compact('brands'))->render();

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
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());

        }
        return response()->json($output);
    }
}
