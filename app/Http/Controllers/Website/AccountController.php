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
    public function __construct()
    {
        $this->middleware('auth:user');
    }
    public function profile()
    {
        if (!Auth::guard('user')->check()) {
            return redirect()->route('home');
        }
        $user = Auth::guard('user')->user();
        // return view('website.account.profile', compact('user'));
        return view('website.profile.profile_update', compact('user'));
    }
    public function orderHistory()
    {

        // $orders = auth()->user()->orders()->paginate(10);
        return view('website.order-history.order-history');
    }
    public function orderDetails()
    {

        // $orders = auth()->user()->orders()->paginate(10);
        return view('website.order-history.order-detail');
    }
    public function rateDetails()
    {

        // $orders = auth()->user()->orders()->paginate(10);
        return view('website.order-history.partials.rate-detail');
    }
    public function cusAddress()
    {

        // $orders = auth()->user()->orders()->paginate(10);
        return view('website.address.cus_address');
    }
    public function editAddress()
    {
       
        // $orders = auth()->user()->orders()->paginate(10);
        return view('website.address.edit_address');
    }

    public function profileUpdate($id, Request $request)
    {
        $rules = [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'phone' => 'nullable',
            'full_mobile' => 'nullable',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                $user->image = ImageManager::upload('uploads/users/', $request->image);
            }

            $user->save();

            DB::commit();
            return response()->json([
                'success' => 1,
                'msg' => __('Update successfully')
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => 0,
                'msg' => __('Something went wrong.')
            ], 500);
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
