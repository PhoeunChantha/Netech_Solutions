<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Http\Controllers\Controller;

class PolicyAndTermController extends Controller
{
    public function privacy_policy()
    {
        $setting =  BusinessSetting::all();
        $data['policy'] = @$setting->where('type', 'policy')->first()->value;
        return view('website.privacy_and_term.privacy_policy',$data);
    }
    public function term_condition()
    {
        $setting =  BusinessSetting::all();
        $data['term_condition'] = @$setting->where('type', 'term_condition')->first()->value;
        return view('website.privacy_and_term.term_condition',$data);
    }
}
