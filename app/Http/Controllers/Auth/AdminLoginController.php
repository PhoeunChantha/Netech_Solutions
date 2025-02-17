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
        $this->middleware('guest:user')->only(['adminLoginPage', 'storeLogin']);
        $this->middleware('auth:user')->only(['adminLogout']);
    }

    public function adminLoginPage()
    {
        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {
        // Validate request first
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            // Attempt login using Auth::attempt()
            if (Auth::guard('user')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ], $request->has('remember'))) {
                return redirect()->route('admin.dashboard')->with(['success' => 1, 'msg' => 'Admin login successful']);
            }

            return redirect()->back()->with(['success' => 0, 'msg' => 'Invalid Email or Password'])->withInput();
        } catch (\Exception $e) {
            \Log::error('Admin Login Error: ' . $e->getMessage());
            return redirect()->back()->with(['success' => 0, 'msg' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function adminLogout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('admin.login')->with('success', __('Logged out successfully.'));
    }
}
