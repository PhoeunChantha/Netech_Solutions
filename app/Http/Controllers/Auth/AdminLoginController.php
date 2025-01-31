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


// class AdminLoginController extends Controller
// {
//     use AuthenticatesUsers;

//     /**
//      * Where to redirect users after login.
//      *
//      * @var string
//      */
//     protected $redirectTo = '/admin/dashboard';

//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('guest:admin')->except('adminLogout');
//         // $this->middleware('auth:admin')->only('logout');
//     }
//     public function adminLoginPage()
//     {
//         return view('auth.login');
//     }
//     public function storeLogin(Request $request)
//     {
//         try {
//             $validator = Validator::make($request->all(), [
//                 'email' => 'required|email',
//                 'password' => 'required',
//             ]);

//             if ($validator->fails()) {
//                 return redirect()->back()
//                     ->withErrors($validator)
//                     ->withInput()
//                     ->with(['success' => 0, 'msg' => 'Invalid form input']);
//             }

//             $admin = Admin::where('email', $request->email)->first();
//             if (!$admin) {
//                 return redirect()->back()->with([
//                     'success' => 0,
//                     'msg' => 'Invalid Email',
//                 ]);
//             }

//             if (!Hash::check($request->password, $admin->password)) {
//                 return redirect()->back()->with([
//                     'success' => 0,
//                     'msg' => 'Invalid Password',
//                 ]);
//             }

//             $credentials = $request->only('email', 'password');
//             if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
//                 return redirect()->route('admin.dashboard')->with([
//                     'success' => 1,
//                     'msg' => 'Login successfully',
//                 ]);
//             }
//             return redirect()->back()->with([
//                 'success' => 0,
//                 'msg' => 'Failed to login',
//             ]);
//         } catch (\Exception $e) {
//             return redirect()->back()->with([
//                 'success' => 0,
//                 'msg' => 'An unexpected error occurred. Please try again later.',
//             ]);
//         }
//     }

//     /**
//      * Specify the guard for admin login.
//      *
//      * @return \Illuminate\Contracts\Auth\StatefulGuard
//      */
//     protected function guard()
//     {
//         return Auth::guard('admin');
//     }


//     /**
//      * Customize redirection after login based on user role.
//      *
//      * @return string
//      */
//     // protected function redirectTo()
//     // {
//     //     if (auth()->user() === 'admin') {
//     //         return '/admin/dashboard';
//     //     }

//     //     auth()->logout();
//     //     return '/login';
//     // }

//     /**
//      * Override the logout method for admin.
//      *
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function adminLogout()
//     {
//         Auth::guard('admin')->logout();
//         return redirect()->route('admin.login')->with('success', __('Logged out successfully.'));
//     }
// }
class AdminLoginController extends Controller
{
    /**
     * Where to redirect users after login.
     */
    protected $redirectToAdmin = '/admin/dashboard';
    protected $redirectToUser = '/user/dashboard';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:admin,user')->except('logout');
    }

    /**
     * Show the login page.
     *
     * @return \Illuminate\View\View
     */
    public function loginPage()
    {
        return view('auth.login');
    }

    /**
     * Handle login for both admin and user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required|in:admin,user',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with(['success' => 0, 'msg' => 'Invalid form input']);
            }

            $role = $request->role; // Get role from the form input

            if ($role === 'admin') {
                // Handle admin login
                $admin = Admin::where('email', $request->email)->first();
                if (!$admin || !Hash::check($request->password, $admin->password)) {
                    return redirect()->back()->with([
                        'success' => 0,
                        'msg' => 'Invalid admin credentials',
                    ]);
                }

                if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember)) {
                    return redirect()->intended($this->redirectToAdmin)->with([
                        'success' => 1,
                        'msg' => 'Admin login successful',
                    ]);
                }
            } elseif ($role === 'user') {
                // Handle user login
                $user = User::where('email', $request->email)->first();
                if (!$user || !Hash::check($request->password, $user->password)) {
                    return redirect()->back()->with([
                        'success' => 0,
                        'msg' => 'Invalid user credentials',
                    ]);
                }

                if (Auth::guard('user')->attempt($request->only('email', 'password'), $request->remember)) {
                    return redirect()->intended($this->redirectToUser)->with([
                        'success' => 1,
                        'msg' => 'User login successful',
                    ]);
                }
            }

            return redirect()->back()->with([
                'success' => 0,
                'msg' => 'Failed to login',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => 0,
                'msg' => 'An unexpected error occurred. Please try again later.',
            ]);
        }
    }

    /**
     * Handle logout for both admin and user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $role = $request->role; // Get role from the request or session

        if ($role === 'admin') {
            Auth::guard('admin')->logout();
        } elseif ($role === 'user') {
            Auth::guard('user')->logout();
        }

        return redirect()->route('login')->with('success', __('Logged out successfully.'));
    }
}
