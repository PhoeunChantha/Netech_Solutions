<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Http\Controllers\Controller;
use App\Models\Employee;

class AboutUsController extends Controller
{
    public function index()
    {
        $data = [];
        $setting = new BusinessSetting();
        $data['about_company'] = @$setting->where('type', 'about_company')->first()->value;
        $data['about_company_image'] = @$setting->where('type', 'about_company_image')->first()->value;
        $data['mission_and_vision'] = @$setting->where('type', 'mission_and_vision')->first()->value;
        $data['teams'] = Employee::where('status', 1)->get();
        return view('website.aboutus.about-us', $data);
    }
}
