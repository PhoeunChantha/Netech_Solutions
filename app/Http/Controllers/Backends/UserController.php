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

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::when($request->start_date && $request->end_date, function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date);
        })
            ->latest('id')
            ->paginate(10);
        return view('backends.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select('name', 'id')
            ->pluck('name', 'id');

        return view('backends.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
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
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $request->username;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make($request['password']);

            $role = Role::findOrFail($request->role);
            $user->assignRole($role->name);

            if ($request->hasFile('image')) {
                $user->image = ImageManager::upload('uploads/users/', $request->image);
            }

            $user->save();
            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return redirect()->route('admin.user.index')->with($output);
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
        // dd($id);
        $user = User::findOrFail($id);
        $roles = Role::select('name', 'id')
            ->pluck('name', 'id');
        return view('backends.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'username' => 'nullable',
            'phone' => 'nullable',
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
            $user->phone = $request->phone;
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

        return redirect()->route('admin.user.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            // if ($user->image) {
            //     ImageManager::delete(public_path('uploads/users/' . $user->image));
            // }
            $user->delete();
            $users = User::latest('id')->paginate(10);
            $view = view('backends.user._table', compact('users'))->render();

            DB::commit();
            $output = [
                'status' => 1,
                'view'  => $view,
                'msg' => __('User Deleted successfully')
            ];
        } catch (Exception $e) {
            DB::rollBack();

            $output = [
                'status' => 0,
                'msg' => __('Something when wrong')
            ];
        }

        return response()->json($output);
    }
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $user->status = $user->status == 1 ? 0 : 1;
            $user->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {

            $output = ['status' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
