<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Banner;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posters = Banner::latest('id')->paginate(10);
        return view('backends.banner.index', compact('posters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('banner.create')) {
            abort(403);
        }
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.banner.create', compact('language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'order' => 'required',
            'image' => 'required',
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
            $banner = new banner;
            $banner->name = $request->name[array_search('en', $request->lang)];
            $banner->description = ($request->description[array_search('en', $request->lang)]);
            $banner->order = $request->order;
            if ($request->hasFile('image')) {
                $banner->image_url = ImageManager::upload('uploads/banner/', $request->image);
            }
            $banner->save();
            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Banner',
                        'translationable_id' => $banner->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Banner',
                        'translationable_id' => $banner->id,
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
        return redirect()->route('admin.banner.index')->with($output);
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
        if (!Gate::allows('banner.edit')) {
            abort(403);
        }
        $banner = Banner::withoutGlobalScopes()->with('translations')->findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.banner.edit', compact('banner', 'language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'order' => 'required',
            'image' => 'required',
            
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
            $banner =  banner::findOrFail($id);
            $banner->name = $request->name[array_search('en', $request->lang)];
            $banner->description = ($request->description[array_search('en', $request->lang)]);
            $banner->order = $request->order;
            if ($request->hasFile('image')) {
                $banner->image_url = ImageManager::update('uploads/banner/', $request->image);
            }
            $banner->save();
            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Banner',
                        'translationable_id' => $banner->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Banner',
                        'translationable_id' => $banner->id,
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
        return redirect()->route('admin.banner.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $banner = Banner::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Banner')
                ->where('translationable_id', $banner->id);

            $translation->delete();
            $banner->delete();

            $banners = Banner::latest('id')->paginate(10);
            $view = view('backends.banner._table', compact('banners'))->render();

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
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $banner = Banner::findOrFail($request->id);
            $banner->status = $banner->status == 1 ? 0 : 1;
            $banner->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
            $output = ['status' => 0, 'msg' => __('Something went wrong')];
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());

        }

        return response()->json($output);
    }
}
