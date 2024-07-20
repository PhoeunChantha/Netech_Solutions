<?php

namespace App\Http\Controllers\Backends;

use Exception;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function index()
    {
        $language_setting = BusinessSetting::where('type', 'language')->first();
        $language = $language_setting ? $language_setting->value : json_encode([]);
        return view('backends.setting.language.index', compact('language'));
    }

    public function create()
    {
        return view('backends.setting.language.partials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ], [
            'name.required' => 'Language is required!',
            'code.required' => 'Country Code is required!',
        ]);

        try {
            DB::beginTransaction();

            $language = BusinessSetting::where('type', 'language')->first();
            $lang_array = [];
            $codes = [];

            if ($language) {
                $language_value = json_decode($language->value, true);

                foreach ($language_value as $data) {
                    if ($data['code'] != $request->code) {
                        if (!array_key_exists('default', $data)) {
                            $data['default'] = $data['code'] == 'gb';
                        }
                        $lang_array[] = $data;
                        $codes[] = $data['code'];
                    }
                }
            }

            $codes[] = $request->code;

            File::put(base_path("resources/lang/{$request->code}.json"), File::get(base_path('resources/lang/en.json')));

            $new_id = count($lang_array) ? max(array_column($lang_array, 'id')) + 1 : 1;
            $lang_array[] = [
                'id' => $new_id,
                'name' => $request->name,
                'code' => $request->code,
                'direction' => $request->direction ?? 'ltr',
                'status' => 1,
                'default' => false,
            ];

            BusinessSetting::updateOrInsert(['type' => 'language'], [
                'value' => json_encode($lang_array),
            ]);

            DB::table('business_settings')->updateOrInsert(['type' => 'pnc_language'], [
                'value' => json_encode($codes),
            ]);

            DB::commit();

            return redirect()->back()->with([
                'success' => 1,
                'msg' => __('Create successfully'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Language creation failed: ' . $e->getMessage());

            return redirect()->back()->with([
                'success' => 0,
                'msg' => __('Something went wrong'),
            ]);
        }
    }

    public function edit(Request $request)
    {
        $language = BusinessSetting::where('type', 'language')->first();
        $lang = [];
        foreach (json_decode($language->value, true) as $data) {
            if ($data['id'] == $request->id) {
                $lang = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'code' => $data['code'],
                ];
            }
        }
        return view('backends.setting.language.partials.edit', compact('lang'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Language is required!',
        ]);

        try {
            DB::beginTransaction();

            $language = BusinessSetting::where('type', 'language')->first();
            $lang_array = [];

            foreach (json_decode($language->value, true) as $data) {
                if ($data['id'] == $request->id) {
                    $lang_array[] = [
                        'id' => $data['id'],
                        'name' => $request->name,
                        'direction' => $request->direction ?? 'ltr',
                        'code' => $request->code,
                        'status' => $data['status'],
                        'default' => $data['code'] == 'en',
                    ];
                } else {
                    $lang_array[] = $data;
                }
            }

            BusinessSetting::where('type', 'language')->update([
                'value' => json_encode($lang_array),
            ]);

            DB::commit();

            return redirect()->back()->with([
                'success' => 1,
                'msg' => __('Update Successfully'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Language update failed: ' . $e->getMessage());

            return redirect()->back()->with([
                'success' => 0,
                'msg' => __('Something went wrong'),
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            $language = BusinessSetting::where('type', 'language')->first();
            $code = $request->code;
            $del_default = false;

            foreach (json_decode($language->value, true) as $data) {
                if ($data['code'] == $code && array_key_exists('default', $data) && $data['default'] == true) {
                    $del_default = true;
                }
            }

            $lang_array = [];
            foreach (json_decode($language->value, true) as $data) {
                if ($data['id'] != $request->id) {
                    $lang_data = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'direction' => $data['direction'] ?? 'ltr',
                        'code' => $data['code'],
                        'status' => $del_default && $data['code'] == 'en' ? 1 : $data['status'],
                        'default' => $del_default && $data['code'] == 'en' ? true : ($data['default'] ?? ($data['code'] == 'en')),
                    ];
                    $lang_array[] = $lang_data;
                }
            }

            BusinessSetting::where('type', 'language')->update([
                'value' => json_encode($lang_array),
            ]);

            $file = base_path("resources/lang/{$request->code}.json");
            if (File::exists($file)) {
                File::delete($file);
            }

            $languages = [];
            $pnc_language = BusinessSetting::where('type', 'pnc_language')->first();
            foreach (json_decode($pnc_language->value, true) as $data) {
                if ($data != $request->code) {
                    $languages[] = $data;
                }
            }
            if (in_array('en', $languages)) {
                unset($languages[array_search('en', $languages)]);
            }
            array_unshift($languages, 'en');

            DB::table('business_settings')->updateOrInsert(['type' => 'pnc_language'], [
                'value' => json_encode($languages),
            ]);

            $language = BusinessSetting::where('type', 'language')->first()->value;
            $view = view('backends.setting.language.partials._table', compact('language'))->render();

            DB::commit();

            return response()->json([
                'status' => 1,
                'msg' => __('Deleted Successfully'),
                'view' => $view,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Language deletion failed: ' . $e->getMessage());

            return response()->json([
                'status' => 0,
                'msg' => __('Something went wrong'),
            ]);
        }
    }

    public function translate(Request $request)
    {
        $lang = $request->code;
        $full_data = json_decode(File::get(base_path("resources/lang/{$lang}.json")), true);

        $lang_data = [];
        foreach ($full_data as $key => $data) {
            $lang_data[] = ['key' => $key, 'value' => $data];
        }

        return view('backends.setting.language.translate', compact('lang', 'lang_data'));
    }

    public function translate_submit(Request $request, $lang)
    {
        $filePath = base_path("resources/lang/{$lang}.json");
        $full_data = json_decode(File::get($filePath), true);

        $key = $request->key;
        $value = mb_convert_encoding($request->value, 'UTF-8');
        $full_data[$key] = $value;

        if (json_encode($full_data) === false) {
            return response()->json(['status' => 0, 'msg' => __('Invalid JSON data')]);
        }

        File::put($filePath, json_encode($full_data, JSON_PRETTY_PRINT));

        return response()->json(['status' => 1, 'msg' => __('Translation updated successfully')]);
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $language = BusinessSetting::where('type', 'language')->first();
            $lang_array = [];
            foreach (json_decode($language->value, true) as $data) {
                if ($data['id'] == $request->id) {
                    $lang_array[] = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'direction' => $data['direction'] ?? 'ltr',
                        'code' => $data['code'],
                        'status' => $data['status'] == 1 ? 0 : 1,
                        'default' => $data['default'] ?? ($data['code'] == 'en'),
                    ];
                } else {
                    $lang_array[] = $data;
                }
            }

            BusinessSetting::where('type', 'language')->update([
                'value' => json_encode($lang_array),
            ]);

            DB::commit();

            return response()->json(['status' => 1, 'msg' => __('Status updated')]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Language status update failed: ' . $e->getMessage());

            return response()->json(['status' => 0, 'msg' => __('Something went wrong')]);
        }
    }

    public function update_default_status(Request $request)
    {
        try {
            DB::beginTransaction();

            $language = BusinessSetting::where('type', 'language')->first();
            $lang_array = [];
            foreach (json_decode($language->value, true) as $data) {
                if ($data['id'] == $request->id) {
                    $lang_array[] = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'direction' => $data['direction'] ?? 'ltr',
                        'code' => $data['code'],
                        'status' => 1,
                        'default' => true,
                    ];
                } else {
                    $lang_array[] = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'direction' => $data['direction'] ?? 'ltr',
                        'code' => $data['code'],
                        'status' => $data['status'],
                        'default' => false,
                    ];
                }
            }

            BusinessSetting::where('type', 'language')->update([
                'value' => json_encode($lang_array),
            ]);

            DB::commit();

            return response()->json([
                'status' => 1,
                'msg' => __('Update Successfully'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Default language status update failed: ' . $e->getMessage());

            return response()->json([
                'status' => 0,
                'msg' => __('Something went wrong'),
            ]);
        }
    }
}
