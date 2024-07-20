<?php

namespace App\Http\Controllers\Backends;

use Exception;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BusinessSettingController extends Controller
{
    public function index()
    {
        $data = [];
        $setting = new BusinessSetting();
        $data['company_name'] = @$setting->where('type', 'company_name')->first()->value;
        $data['phone'] = @$setting->where('type', 'phone')->first()->value;
        $data['email'] = @$setting->where('type', 'email')->first()->value;
        $data['telegram'] = @$setting->where('type', 'telegram')->first()->value;
        $data['about_club'] = @$setting->where('type', 'about_club')->first()->value;
        $data['company_address'] = @$setting->where('type', 'company_address')->first()->value;
        $data['copy_right_text'] = @$setting->where('type', 'copy_right_text')->first()->value;
        $data['timezone'] = @$setting->where('type', 'timezone')->first()->value;
        $data['currency'] = @$setting->where('type', 'currency')->first()->value;

        // account info
        $data['account_holder'] = @$setting->where('type', 'account_holder')->first()->value;
        $data['account_number'] = @$setting->where('type', 'account_number')->first()->value;
        $data['bank'] = @$setting->where('type', 'bank')->first()->value;
        $data['swift_code'] = @$setting->where('type', 'swift_code')->first()->value;
        $data['bank_address'] = @$setting->where('type', 'bank_address')->first()->value;
        $data['account_holder_address'] = @$setting->where('type', 'account_holder_address')->first()->value;

        $data['social_medias'] = [];
        $social_media = $setting->where('type', 'social_media')->first();
        if ($social_media) {
            $data['social_medias'] = $social_media->value;
        }

        $data['web_header_logo'] = @$setting->where('type', 'web_header_logo')->first()->value;
        $data['web_banner_logo'] = @$setting->where('type', 'web_banner_logo')->first()->value;
        $data['fav_icon'] = @$setting->where('type', 'fav_icon')->first()->value;

        if (request()->ajax()) {
            $key = request('key');
            $tr = view('backends.setting.partials._social_media_tr', compact('key'))->render();
            return response()->json([
                'tr' => $tr
            ]);
        }

        return view('backends.setting.index', $data);
    }

    public function update(Request $request)
    {
        $request->validate([]);
        try {
            DB::beginTransaction();
            $all_input = $request->all();
            foreach ($all_input as $input_name => $input_value) {
                // save image
                if ($request->hasFile($input_name) && !in_array($input_name, ['social_media'])) {
                    $old_image = BusinessSetting::where('type', $input_name)->first();
                    $image = ImageManager::update('uploads/business_settings/', $old_image, $request->$input_name);

                    BusinessSetting::updateOrCreate(
                        [
                            'type' => $input_name,
                        ],
                        [
                            'value' => $image,
                        ]
                    );
                    continue;
                }

                // save text
                if (!in_array($input_name, ['_token', '_method', 'social_media'])) {
                    BusinessSetting::updateOrCreate(
                        [
                            'type' => $input_name,
                        ],
                        [
                            'value' => $input_value,
                        ]
                    );
                }
            }

            // social media
            $social_media = [];
            if ($request->social_media) {
                foreach ($request->social_media['title'] as $key => $value) {
                    $item['title'] = $request->social_media['title'][$key];
                    $item['link'] = $request->social_media['link'][$key];

                    $request_icon = $request->social_media['icon'] ?? 0;

                    if ($request_icon != 0) {
                        if (in_array($key, array_keys($request->social_media['icon']))) {
                            $icon = ImageManager::update('uploads/social_media/', $request->social_media['old_icon'][$key], $request->social_media['icon'][$key]);
                            $item['icon'] = asset('uploads/social_media/' . $icon);
                        } else {
                            $item['icon'] = $request->social_media['old_icon'][$key] ?? null;
                        }
                    } else {
                        $item['icon'] = $request->social_media['old_icon'][$key];
                    }

                    if (array_key_exists('status_' . $key, $request->social_media)) {
                        $item['status'] = 1;
                    } else {
                        $item['status'] = 0;
                    }

                    array_push($social_media, $item);
                }
            }


            BusinessSetting::updateOrCreate(
                [
                    'type' => 'social_media',
                ],
                [
                    'value' => json_encode($social_media),
                ]
            );

            DB::commit();
            return redirect()->route('admin.setting.index')->with([
                'success' => 1,
                'msg' => __('Updated sucessfully')
            ]);
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('admin.setting.index')->with([
                'success' => 0,
                'msg' => __('Something went wrong')
            ]);
        }
    }

    public function webContent()
    {
        $data = [];
        $setting = new BusinessSetting();
        $data['why_ci'] = @$setting->where('type', 'why_ci')->first()->value;
        $data['how_to_enter'] = @$setting->where('type', 'how_to_enter')->first()->value;
        $data['offline_application'] = @$setting->where('type', 'offline_application')->first()->value;
        $data['why_should_i_sponsor'] = @$setting->where('type', 'why_should_i_sponsor')->first()->value;
        $data['how_to_participate'] = @$setting->where('type', 'how_to_participate')->first()->value;

        // return json_decode($data['why_ci'], true);

        if (request()->ajax()) {
            if (request('table') == 'how_to_enter') {
                $key = request('key');
                $tr = view('backends.setting.partials._how_to_enter_tr', compact('key'))->render();
                return response()->json([
                    'tr' => $tr
                ]);
            }
            if (request('table') == 'why_sponsor') {
                $key = request('key');
                $tr = view('backends.setting.partials._why_should_i_sponser_tr', compact('key'))->render();
                return response()->json([
                    'tr' => $tr
                ]);
            }
        }

        return view('backends.setting.web_content', $data);
    }

    public function webContentUpdate(Request $request)
    {
        // return $request->all();
        try {
            DB::beginTransaction();

            $all_input = $request->all();
            foreach ($all_input as $input_name => $input_value) {
                // save file
                if ($request->hasFile($input_name)) {
                    $old_file = BusinessSetting::where('type', $input_name)->first()->value;
                    $file = ImageManager::update('uploads/business_settings/', $old_file, $request->$input_name);

                    BusinessSetting::updateOrCreate(
                        [
                            'type' => $input_name,
                        ],
                        [
                            'value' => $file,
                        ]
                    );
                    continue;
                }

                // save text
                if (!in_array($input_name, ['_token', '_method', 'why_ci', 'how_to_enter', 'why_should_i_sponsor'])) {
                    BusinessSetting::updateOrCreate(
                        [
                            'type' => $input_name,
                        ],
                        [
                            'value' => $input_value,
                        ]
                    );
                }
            }

            // why cigfg
            $why_ci = [];
            if ($request->why_ci) {
                foreach ($request->why_ci['title'] as $key => $value) {
                    $item['title'] = $request->why_ci['title'][$key];
                    $item['description'] = $request->why_ci['description'][$key];
                    array_push($why_ci, $item);
                }

                BusinessSetting::updateOrCreate(
                    [
                        'type' => 'why_ci',
                    ],
                    [
                        'value' => json_encode($why_ci),
                    ]
                );
            }

            // how to enter
            $how_to_enter = [];
            if ($request->how_to_enter) {
                foreach ($request->how_to_enter['title'] as $key => $value) {
                    $item['title'] = $request->how_to_enter['title'][$key];
                    $item['description'] = $request->how_to_enter['description'][$key];
                    array_push($how_to_enter, $item);
                }

                BusinessSetting::updateOrCreate(
                    [
                        'type' => 'how_to_enter',
                    ],
                    [
                        'value' => json_encode($how_to_enter),
                    ]
                );
            }

            // why should i sponsor
            $why_should_i_sponsor = [];
            if ($request->why_should_i_sponsor) {
                foreach ($request->why_should_i_sponsor['description'] as $key => $value) {
                    $item['description'] = $request->why_should_i_sponsor['description'][$key];

                    $request_icon = $request->why_should_i_sponsor['icon'] ?? 0;

                    if ($request_icon != 0) {
                        if (in_array($key, array_keys($request->why_should_i_sponsor['icon']))) {
                            $icon = ImageManager::update('uploads/business_settings/', $request->why_should_i_sponsor['old_icon'][$key], $request->why_should_i_sponsor['icon'][$key]);
                            $item['icon'] = asset('uploads/business_settings/' . $icon);
                        } else {
                            $item['icon'] = $request->why_should_i_sponsor['old_icon'][$key] ?? null;
                        }
                    } else {
                        $item['icon'] = $request->why_should_i_sponsor['old_icon'][$key];
                    }

                    // if (array_key_exists('status_'. $key, $request->why_should_i_sponsor)) {
                    //     $item['status'] = 1;
                    // } else {
                    //     $item['status'] = 0;
                    // }

                    array_push($why_should_i_sponsor, $item);
                }
                BusinessSetting::updateOrCreate(
                    [
                        'type' => 'why_should_i_sponsor',
                    ],
                    [
                        'value' => json_encode($why_should_i_sponsor),
                    ]
                );
            }

            DB::commit();
            return redirect()->back()->with([
                'success' => 1,
                'msg' => __('Updated sucessfully')
            ]);
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with([
                'success' => 0,
                'msg' => __('Something went wrong')
            ]);
        }
    }
}
