<?php

namespace App\Http\Controllers\Website\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function signin()
    {
        return view('website.web_login.login');
    }
    public function signup()
    {
        return view('website.web_login.sign-up');
    }
    public function register(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'signup_first_name' => 'required',
            'signup_last_name' => 'required',
            'signup_phone' => 'required',
            'signup_password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $user = new User;
            $user->first_name = $request->signup_first_name;
            $user->last_name = $request->signup_last_name;
            $user->name = $request->signup_first_name . $request->signup_last_name;
            $user->phone = $request->full_mobile;
            // $user->terms = $request->terms;
            // $user->email = $request->email;
            $user->password = Hash::make($request->signup_password);
            $user->save();
            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Sign up successfully')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            // $output = [
            //     'success' => 0,
            //     'msg' => __('Something went wrong')
            // ];
        }
        return redirect()->route('customer.login')->with($output);
    }
    public function recover()
    {
        return view('website.web_login.recover-password');
    }
    public function changePassword()
    {
        return view('website.web_login.new-password');
    }
    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'signin_phone' => 'required',
            'signin_password' => 'required',
            'g-recaptcha-response' => 'required',
        ]);

        // Verify reCAPTCHA
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = env('RECAPTCHA_SECRET_KEY');

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ]);

        $verificationResult = $response->json();
        if (!$verificationResult['success']) {
            return redirect()->back()->with(['warning' => 1, 'msg' => __('reCAPTCHA verification failed!')]);
        }
        try {
            if (Auth::attempt(['phone' => request('signin_phone'), 'password' => request('signin_password')])) {

                $user = User::findOrFail(auth()->user()->id);
                $user_roles = $user->getRoleNames()->toArray();

                if (in_array('admin', $user_roles)) {
                    return redirect()->route('admin.dashboard')->with(['success' => 1, 'msg' => __('Login successfully.')]);
                }

                if (!empty($user_roles) && in_array($user_roles[0], ['normal-user'])) {
                    return redirect()->route('home')->with(['success' => 1, 'msg' => __('Login successfully.')]);
                } else {
                    return redirect()->back()->with(['warning' => 1, 'msg' => __('Invalid role!')]);
                }
            } else {
                return redirect()->back()->with(['warning' => 1, 'msg' => __('Invalid credentials!')]);
            }
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with(['danger' => 1, 'msg' => __('Something went wrong!')]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->back();
    }
}
