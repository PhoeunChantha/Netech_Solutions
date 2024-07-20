<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::select('name', 'id')
            ->pluck('name', 'id');
        return view('backends.user.update_profile', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'user_id' => 'required|unique:users,user_id,' . $id,
            'phone' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            // 'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $request->username;
            $user->user_id = $request->user_id;
            $user->phone = $request->phone;
            $user->telegram = $request->telegram ?? null;
            $user->email = $request->email;

            $role_id        = $request->role;
            $user_role      = $user->roles->first();
            $previous_role  = !empty($user_role->id) ? $user_role->id : 0;
            if ($previous_role != $role_id) {
                if (!empty($previous_role)) {
                    $user->removeRole($user_role->name);
                }

                $role = Role::findOrFail($role_id);
                $user->assignRole($role->name);
            }

            if ($request->password) {
                $user->password = Hash::make($request['password']);
            }
            if ($request->hasFile('image')) {
                $user->image = ImageManager::update('uploads/users/', $user->image, $request->image);
            }

            $user->save();

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return redirect()->route('admin.dashboard')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
