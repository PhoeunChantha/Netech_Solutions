<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('adminLogout');
    }

    public function adminLoginPage()
    {
        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with(['success' => 0, 'msg' => 'Invalid form input']);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->back()->with(['success' => 0, 'msg' => 'Invalid Email']);
            }

            if ($user) {
                if (!Hash::check($request->password, $user->password)) {
                    return redirect()->back()->with(['success' => 0, 'msg' => 'Invalid Password']);
                }

                if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                    return redirect()->route('admin.dashboard')->with(['success' => 1, 'msg' => 'Admin login successful']);
                }
            }

            return redirect()->back()->with(['success' => 0, 'msg' => 'Failed to login']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['success' => 0, 'msg' => 'Please try again later.']);
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', __('Logged out successfully.'));
    }
}
