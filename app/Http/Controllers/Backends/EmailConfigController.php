<?php

namespace App\Http\Controllers\Backends;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmailConfigController extends Controller
{
    public function showForm()
    {
        return view('backends.email_config.Email_config');
    }

    public function updateConfig(Request $request)
    {
        try {
            $config_data = [
                'MAIL_MAILER' => $request->input('MAIL_MAILER'),
                'MAIL_HOST' => $request->input('MAIL_HOST'),
                'MAIL_PORT' => $request->input('MAIL_PORT'),
                'MAIL_USERNAME' => $request->input('MAIL_USERNAME'),
                'MAIL_PASSWORD' => $request->input('MAIL_PASSWORD'),
                'MAIL_ENCRYPTION' => $request->input('MAIL_ENCRYPTION'),
                'MAIL_FROM_ADDRESS' => $request->input('MAIL_FROM_ADDRESS'),
                'MAIL_FROM_NAME' => $request->input('MAIL_FROM_NAME'),
            ];

            $env_path = base_path('.env');
            $env_content = File::get($env_path);

            foreach ($config_data as $key => $value) {
                $pattern = "/^$key=.*/m";
                $replacement = "$key=\"$value\"";
                if (preg_match($pattern, $env_content)) {
                    $env_content = preg_replace($pattern, $replacement, $env_content);
                } else {
                    $env_content .= "\n$replacement";
                }
            }

            File::put($env_path, $env_content);

            $output = [
                'success' => 1,
                'msg' => __('Updated successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }


        return redirect()->route('admin.email_config_form')->with($output);
    }
}
