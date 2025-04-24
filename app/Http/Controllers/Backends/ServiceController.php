<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Service;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categories = Category::all();
        $services = Service::when($request->category_id, function ($query) use ($request) {
            $query->where('category_id', $request->category_id);
        })->latest('id')->paginate(10);

        if ($request->ajax()) {
            $view = view('backends.servicepage._table', compact('services', 'categories'))->render();
            return response()->json([
                'view' => $view
            ]);
        }
        // $products = Product::latest('id')->paginate(10);
        return view('backends.servicepage.index', compact('services', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('service.create')) {
            abort(403);
        }
        $services = Service::with('category')->get();
        $categories = Category::all();
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.servicepage.create', compact('services', 'categories', 'language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'thumbnails' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
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
            // dd($request->all());
            $service = new Service();
            $service->name = $request->name[array_search('en', $request->lang)];
            $service->slug = Str::slug($request->name[array_search('en', $request->lang)]);
            $service->description = $request->description[array_search('en', $request->lang)];
            $service->category_id = $request->category_id ?? null;
            if ($request->hasFile('thumbnails')) {
                $service->thumbnails = ImageManager::upload('uploads/serviceimg/', $request->thumbnails);
            }

            $service->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Service',
                        'translationable_id' => $service->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ];
                }
            }

            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Service',
                        'translationable_id' => $service->id,
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
           
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());

        }
        return redirect()->route('admin.service.index')->with($output);
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
        if (!Gate::allows('service.edit')) {
            abort(403);
        }
        $categories = Category::all();
        $service = Service::withoutGlobalScopes()->with('translations')->with('category')->findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.servicepage.edit', compact('service', 'categories', 'language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'thumbnails' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
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

            $service = Service::findOrFail($id);
            $service->name = $request->name[array_search('en', $request->lang)];
            $service->description = $request->description[array_search('en', $request->lang)];
            $service->slug = Str::slug($request->name[array_search('en', $request->lang)]);
            $service->category_id = $request->category_id ?? null;
            if ($request->hasFile('thumbnails')) {
                $oldImage = $service->thumbnails;
                $service->thumbnails = ImageManager::update('uploads/serviceimg/', $oldImage, $request->file('thumbnails'));
                // $brand->save();
            }
            $service->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Service',
                        'translationable_id' => $service->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ];
                }
            }

            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Service',
                        'translationable_id' => $service->id,
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
           
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());
        }

        return redirect()->route('admin.service.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $service = Service::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Product')
                ->where('translationable_id', $service->id);
            $translation->delete();
            $service->delete();

            $services = Service::latest('id')->paginate(10);
            $view = view('backends.servicepage._table', compact('services'))->render();

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

            $service = Service::findOrFail($request->id);
            $service->status = $service->status == 1 ? 0 : 1;
            $service->save();

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
