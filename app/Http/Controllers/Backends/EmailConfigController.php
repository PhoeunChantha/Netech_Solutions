<?php

namespace App\Http\Controllers\Backends;

use Illuminate\Http\Request;
use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class EmailConfigController extends Controller
{
    public function showForm()
    {
        $emailConfig = EmailConfiguration::first();
        return view('backends.email_config.Email_config', compact('emailConfig'));
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
    // public function updateConfig(Request $request)
    // {
    //     try {
    //         $validatedData = $request->validate([
    //             'MAIL_MAILER' => 'required|string',
    //             'MAIL_HOST' => 'nullable|string',
    //             'MAIL_PORT' => 'nullable|numeric',
    //             'MAIL_USERNAME' => 'nullable|string',
    //             'MAIL_PASSWORD' => 'nullable|string',
    //             'MAIL_ENCRYPTION' => 'nullable|string',
    //             'MAIL_FROM_ADDRESS' => 'nullable|email',
    //             'MAIL_FROM_NAME' => 'nullable|string',
    //         ]);
    
    //         $validatedData = [
    //             'mail_mailer' => $validatedData['MAIL_MAILER'],
    //             'mail_host' => $validatedData['MAIL_HOST'],
    //             'mail_port' => $validatedData['MAIL_PORT'],
    //             'mail_username' => $validatedData['MAIL_USERNAME'],
    //             'mail_password' => $validatedData['MAIL_PASSWORD'],
    //             'mail_encryption' => $validatedData['MAIL_ENCRYPTION'],
    //             'mail_from_address' => $validatedData['MAIL_FROM_ADDRESS'],
    //             'mail_from_name' => $validatedData['MAIL_FROM_NAME'],
    //         ];
    
    //         $emailConfig = EmailConfiguration::first();
    
    //         if ($emailConfig) {
    //             $emailConfig->update($validatedData);
    //         } else {
    //             EmailConfiguration::create($validatedData);
    //         }
    
    //         return redirect()->route('admin.email_config_form')->with([
    //             'success' => 1,
    //             'msg' => __('Updated successfully')
    //         ]);
    //     } catch (\Exception $e) {
    //         \Log::error($e->getMessage());
    //         return redirect()->route('admin.email_config_form')->with([
    //             'success' => 0,
    //             'msg' => __('Something went wrong: ') . $e->getMessage()
    //         ]);
    //     }
    // }
    
    
}
