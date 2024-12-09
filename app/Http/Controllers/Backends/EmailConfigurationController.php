<?php

namespace App\Http\Controllers\Backends;

use Exception;
use Illuminate\Http\Request;
use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmailConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $email = EmailConfiguration::first();
        return view('backends.email_config.email_configuration', compact('email'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mail_host' => 'required',
            'email' => 'required',
            'smtp_username' => 'required',
            'smtp_password' => 'required',
            'mail_port' => 'required',
            'mail_encryption' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }
        try {
            DB::beginTransaction();
            $email = EmailConfiguration::first();
            $email->mail_host = $request->mail_host;
            $email->email = $request->email;
            $email->smtp_username = $request->smtp_username;
            $email->smtp_password = $request->smtp_password;
            $email->mail_port = $request->mail_port;
            $email->mail_encryption = $request->mail_encryption;
            $email->save();

            $notification =  trans('admin_validation.Update Successfully');
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return redirect()->back()->with($notification);
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => ('Update Successfully'),
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }
        return redirect()->back()->with($output);
    }
}
