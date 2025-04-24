<?php

namespace App\Http\Controllers\Backends;

use Exception;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TermAndPolicyController extends Controller
{
    public function termAndCondition()
    {
        $data = [];
        $setting = new BusinessSetting();
        $data['term_condition'] = @$setting->where('type', 'term_condition')->first()->value;
        return view('backends.term_condition.term_condition', $data);
    }
    public function updateterm(Request $request)
    {
        $request->validate([]);
        try {
            DB::beginTransaction();
            $all_input = $request->all();
            foreach ($all_input as $input_name => $input_value) {
                // save image
                if ($request->hasFile($input_name) && !in_array($input_name, ['social_media', 'contact'])) {
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
                if (!in_array($input_name, ['_token', '_method', 'social_media', 'contact'])) {
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


            DB::commit();
            return redirect()->route('admin.term_condition')->with([
                'success' => 1,
                'msg' => __('Updated sucessfully')
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.term_condition')->with([
                'success' => 0,
                'msg' => __('Something went wrong')
            ]);
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());

        }
    }
    public function policy()
    {
        $data = [];
        $setting = new BusinessSetting();
        $data['policy'] = @$setting->where('type', 'policy')->first()->value;
        return view('backends.term_condition.policy', $data);
    }
    public function updatepolicy(Request $request)
    {
        $request->validate([]);
        try {
            DB::beginTransaction();
            $all_input = $request->all();
            foreach ($all_input as $input_name => $input_value) {
                // save image
                if ($request->hasFile($input_name) && !in_array($input_name, ['social_media', 'contact'])) {
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
                if (!in_array($input_name, ['_token', '_method', 'social_media', 'contact'])) {
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


            DB::commit();
            return redirect()->route('admin.policy')->with([
                'success' => 1,
                'msg' => __('Updated sucessfully')
            ]);
        } catch (Exception $e) {
           
            DB::rollBack();
            return redirect()->route('admin.policy')->with([
                'success' => 0,
                'msg' => __('Something went wrong')
            ]);
            \Log::emergency('Line:' . $e->getLine() . ' ' . 'Message:' . $e->getMessage());

        }
    }
}
