<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Symfony\Component\HttpFoundation\Response;

class SetFrontendSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $business = new BusinessSetting;

        $app_icon = @$business->where('type', 'fav_icon')->first()->value;
        $copy_right_text = @$business->where('type', 'copy_right_text')->first()->value;
        $app_logo = @$business->where('type', 'web_header_logo')->first()->value;
        $web_banner_logo = @$business->where('type', 'web_banner_logo')->first()->value;
        $app_name = @$business->where('type', 'company_name')->first()->value;
        $phone = @$business->where('type', 'phone')->first()->value;
        $telegram = @$business->where('type', 'telegram')->first()->value;
        $about_club = @$business->where('type', 'about_club')->first()->value;
        $company_address = @$business->where('type', 'company_address')->first()->value;


        $request->session()->put('app_icon', $app_icon);
        $request->session()->put('copy_right_text', $copy_right_text);
        $request->session()->put('app_logo', $app_logo);
        $request->session()->put('web_banner_logo', $web_banner_logo);
        $request->session()->put('app_name', $app_name);
        $request->session()->put('phone', $phone);
        $request->session()->put('telegram', $telegram);
        $request->session()->put('about_club', $about_club);
        $request->session()->put('company_address', $company_address);

        return $next($request);
    }
}
