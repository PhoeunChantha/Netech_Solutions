<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Video;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::latest('id')->paginate(10);
        return view('backends.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('video.create')) {
            abort(403);
        }
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.video._create', compact('language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'thumbnails' => 'required',
            'description' => 'required',
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
                ->with(['success' => 0, 'msg' => ('Invalid form input')]);
        }
        try {
            DB::beginTransaction();
            $video = new Video();
            $video->name = $request->name[array_search('en', $request->lang)];
            $video->description = ($request->description[array_search('en', $request->lang)]);
            $video->video_type = $request->video_type;
            $video->video_url = $request->video_url;
            $video->video_id = $request->video_id;
            $video->created_by = auth()->user()->id;

            if ($request->hasFile('thumbnail')) {
                $video->thumbnail = ImageManager::upload('uploads/videos/', $request->thumbnail);
            }
            $video->save();
            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Video',
                        'translationable_id' => $video->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Video',
                        'translationable_id' => $video->id,
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
        return redirect()->route('admin.video.index')->with($output);
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
        if (!Gate::allows('video.edit')) {
            abort(403);
        }
        $video = Video::withoutGlobalScopes()->with('translations')->findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.video.edit', compact('video', 'language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'thumbnail' => 'required',
            'description' => 'required',
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
                ->with(['success' => 0, 'msg' => ('Invalid form input')]);
        }
        try {
            DB::beginTransaction();
            $video = Video::findOrFail($id);
            $video->name = $request->name[array_search('en', $request->lang)];
            $video->description = ($request->description[array_search('en', $request->lang)]);
            $video->video_type = $request->video_type;
            $video->video_url = $request->video_url;
            $video->video_id = $request->video_id;
            // $video->video = $request->video;
            $video->created_by = auth()->user()->id;
            // if ($request->hasFile('thumbnail')) {
            //     $video->thumbnail = ImageManager::upload('uploads/videos/', $request->thumbnail);
            // }
           
            if ($request->hasFile('thumbnail')) {
                $oldImage = $video->thumbnail;
                $video->thumbnail = ImageManager::update('uploads/videos/', $oldImage, $request->file('thumbnail'));
            }
            $video->save();
            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Video',
                        'translationable_id' => $video->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Video',
                        'translationable_id' => $video->id,
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
                'msg' => ('Updated successfully'),
            ];
        } catch (Exception $e) {
           
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());
        }
        return redirect()->route('admin.video.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $video = Video::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Video')
                ->where('translationable_id', $video->id);

            $translation->delete();
            $video->delete();

            $videos = Video::latest('id')->paginate(10);
            $view = view('backends.video._table', compact('videos'))->render();

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

            $video = Video::findOrFail($request->id);
            $video->status = $video->status == 1 ? 0 : 1;
            $video->save();

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
