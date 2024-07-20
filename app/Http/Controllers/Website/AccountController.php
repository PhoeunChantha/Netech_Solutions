<?php

namespace App\Http\Controllers\Website;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $user = auth()->user();
        return view('website.account.profile', compact('user'));
    }

    public function profileUpdate($id, Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            // dd($request->all());
            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->telegram = $request->telegram;
            if ($request->password) {
                $user->password = Hash::make($request['password']);
            }

            if ($request->hasFile('image')) {
                $user->image = ImageManager::upload('uploads/users/', $request->image);
            }

            $user->save();

            DB::commit();
            return redirect()->back()->with(['success' => 1, 'msg' => __('Update successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with([
                'success' => 0,
                'msg' => __('Something went wrong.')
            ]);
        }
    }
    public function profileStore(Request $request)
    {
        $rules = [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'name'          => 'required',
            'phone'         => 'required',
            'email'         => 'required|unique:users',
            'password'      => 'nullable|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errorMessage = '';
            // Check for specific validation errors
            if ($validator->errors()->has('email')) {
                $errorMessage = __('The email has already been taken');
            } elseif ($validator->errors()->has('password')) {
                $errorMessage = __('Passwords do not match');
            } else {
                $errorMessage = $validator->errors()->first(); // Default to the first error message
            }
            return redirect()->back()->with(['warning' => 1, 'msg' => $errorMessage]);
        }

        try {
            DB::beginTransaction();
            // dd($request->all());
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            if ($request->filled('password') && $request->has('password')) {
                $user->password = Hash::make($request['password']);
            }

            if ($request->hasFile('image')) {
                $user->image = ImageManager::update('uploads/users/', $user->image, $request->image);
            }

            $user->save();

            // Assign the normal-user role to the newly created user
            $user->assignRole('normal-user');

            DB::commit();

            return redirect()->back()->with(['register' => true]);
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'danger' => 1,
                'msg' => __('Something went wrong.')
            ];
            return redirect()->route('home')->with($output);
        }
    }
}
