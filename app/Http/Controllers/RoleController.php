<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->can('view-roles')) abort(403);
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        if (!auth()->user()->can('create-roles')) abort(403);
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('create-roles')) abort(403);
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->input('permissions', []));
        // Sync users to this role if provided
        if ($request->has('users')) {
            foreach ($request->input('users', []) as $userId) {
                $user = \App\Models\User::find($userId);
                if ($user) $user->assignRole($role);
            }
        }
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        if (!auth()->user()->can('edit-roles')) abort(403);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        if (!auth()->user()->can('edit-roles')) abort(403);
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->input('permissions', []));
        // Sync users to this role
        $allUsers = \App\Models\User::all();
        foreach ($allUsers as $user) {
            if ($request->has('users') && in_array($user->id, $request->input('users', []))) {
                if (!$user->roles->pluck('id')->contains($role->id)) {
                    $user->assignRole($role);
                }
            } else {
                if ($user->roles->pluck('id')->contains($role->id)) {
                    $user->removeRole($role);
                }
            }
        }
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if (!auth()->user()->hasRole('admin')) abort(403);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
} 