<?php

namespace App\Http\Controllers\Backends;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('backends.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('role.create')) {
            abort(403);
        }
        return view('backends.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        $role_name = $validated['name'];
        $permissions = $validated['permissions'];

        // Create the role
        $role = Role::create(['name' => $role_name]);

        // Create permissions if they do not exist
        $this->__createPermissionIfNotExists($permissions);

        // Sync permissions with the role
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $output = [
            'success' => 1,
            'msg' => __("Admin role created successfully")
        ];

        return redirect()->route('admin.role.index')->with($output);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!Gate::allows('role.edit')) {
            abort(403);
        }
        $role = Role::with('permissions')->findOrFail($id);
        $role_permissions = $role->permissions->pluck('name')->toArray();

        return view('backends.role.edit', compact('role', 'role_permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions' => 'array'
        ]);

        $role_name = $validated['name'];
        $permissions = $validated['permissions'] ?? [];

        // Update the role
        $role = Role::findOrFail($id);
        $role->name = $role_name;
        $role->save();

        // Create permissions if they do not exist
        $this->__createPermissionIfNotExists($permissions);

        // Sync permissions with the role
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $output = [
            'success' => 1,
            'msg' => __("Admin role updated successfully")
        ];

        return redirect()->route('admin.role.index')->with($output);
    }

    /**
     * Create permissions if they do not exist.
     */
    private function __createPermissionIfNotExists(array $permissions)
    {
        $existing_permissions = Permission::whereIn('name', $permissions)
            ->pluck('name')
            ->toArray();

        $non_existing_permissions = array_diff($permissions, $existing_permissions);

        foreach ($non_existing_permissions as $new_permission) {
            Permission::create([
                'name' => $new_permission,
                'guard_name' => 'user'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $role = Role::findOrFail($id);
            $role->delete();

            $roles = Role::latest('id')->paginate(10);
            $view = view('backends.role._table', compact('roles'))->render();

            DB::commit();

            $output = [
                'status' => 1,
                'view' => $view,
                'msg' => __('Role Deleted successfully.')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            // Log the exception
            \Log::error('Role deletion error: ' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return response()->json($output);
    }
}
