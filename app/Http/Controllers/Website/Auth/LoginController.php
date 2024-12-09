<?php

namespace App\Http\Controllers\Website\Auth;

use Exception;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware('guest:user')->except('userLogout');
    }

    public function signin()
    {
        return view('website.web_login.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'signin_email' => 'required|email',
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
            return redirect()->back()->with([
                'warning' => 1,
                'msg' => __('reCAPTCHA verification failed!'),
            ])->withInput();
        }

        try {
            $user = User::where('email', $request->signin_email)->first();
            if (!$user) {
                return redirect()->back()->with([
                    'success' => 0,
                    'msg' => 'Invalid Email',
                ])->withInput();
            }

            if (!Hash::check($request->signin_password, $user->password)) {
                return redirect()->back()->with([
                    'success' => 0,
                    'msg' => 'Invalid Password',
                ])->withInput();
            }

            // Attempt login
            $credentials = [
                'email' => $request->signin_email,
                'password' => $request->signin_password,
            ];
            if (Auth::guard('user')->attempt($credentials, $request->remember)) {
                return redirect()->route('home')->with([
                    'success' => 1,
                    'msg' => 'Login successful',
                ]);
            }

            return redirect()->back()->with([
                'success' => 0,
                'msg' => 'Failed to login',
            ])->withInput();
        } catch (\Exception $e) {
            dd($e);
            \Log::error('Login error: ' . $e->getMessage());
            // return redirect()->back()->with([
            //     'success' => 0,
            //     'msg' => 'An unexpected error occurred. Please try again later.',
            // ])->withInput();
        }
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
            'signup_email' => 'required',
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
            $user->email = $request->signup_email;
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
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }
        return redirect()->route('customer.web.login')->with($output);
    }
    public function recover()
    {
        return view('website.web_login.recover-password');
    }
    public function sendForgetPassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
            ],
            [
                'email.required' => __('The email field is required.'),
                'email.email' => __('Please provide a valid email address.'),
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $email = $request->email;
        $request->session()->put('verify_email', $email);

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with([
                'success' => 0,
                'msg' => __('No user found with this email.'),
            ]);
        }

        $otp = rand(100000, 999999);
        $request->session()->put('otp', $otp);
        $request->session()->put('otp_expires_at', now()->addMinutes(2));
        $message = "Your OTP is: $otp";

        try {
            Mail::to($user->email)->send(new OtpMail($message, $otp));
            return redirect()->route('verifyOtp-Form')->with([
                'success' => 1,
                'msg' => __('OTP sent successfully.'),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => 0,
                'msg' => __('Something went wrong. Please try again later.'),
            ]);
        }
    }

    public function showVerifyOtpForm()
    {
        return view('website.web_login.user_verify_code_form');
    }
    public function verifyOtp(Request $request)
    {
        $enteredOtp = implode('', [
            $request->input('otp_1'),
            $request->input('otp_2'),
            $request->input('otp_3'),
            $request->input('otp_4'),
            $request->input('otp_5'),
            $request->input('otp_6'),
        ]);

        $sessionOtp = Session::get('otp');
        $otpExpiresAt = Session::get('otp_expires_at');
        $request->validate([
            'otp_1' => 'required|numeric|digits:1',
            'otp_2' => 'required|numeric|digits:1',
            'otp_3' => 'required|numeric|digits:1',
            'otp_4' => 'required|numeric|digits:1',
            'otp_5' => 'required|numeric|digits:1',
            'otp_6' => 'required|numeric|digits:1',
        ]);

        if ($enteredOtp == $sessionOtp && $otpExpiresAt && now()->lessThanOrEqualTo($otpExpiresAt)) {
            Session::forget('otp');
            Session::forget('otp_expires_at');
            return redirect()->route('resetPasswordOtp')->with([
                'success' => 1,
                'msg' => __('OTP verified successfully.'),
            ]);
        }

        return redirect()->back()->with([
            'success' => 0,
            'msg' => __('Invalid or expired OTP code.'),
        ]);
    }

    public function resetPasswordOtp()
    {
        $user = User::select('id', 'name', 'email')->first();
        return view('website.web_login.user_verify_reset_pass', compact('user'));
    }
    public function otpNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ],[
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Confirm password does not match',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with([
                'success' => 0,
                'msg' => __('No user found with this email address.'),
            ]);
        }
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(100);
        $user->save();

        session()->forget('email');
        return redirect()->route('customer.web.login')->with([
            'success' => 1,
            'msg' => __('Password reset successfully'),
        ]);
    }

    public function changePassword()
    {
        return view('website.web_login.new-password');
    }


    public function userLogout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('customer.web.login');
    }
}
