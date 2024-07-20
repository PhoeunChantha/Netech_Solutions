<?php

namespace App\Http\Controllers\Website\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
        ]);
        try {
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

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
            // dd($e);
            return redirect()->back()->with(['danger' => 1, 'msg' => __('Something went wrong!')]);
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect()->back();
    }
}
