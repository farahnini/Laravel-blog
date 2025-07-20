<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->can('view-users')) abort(403);
        $users = User::with('roles', 'permissions')->paginate(12);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->can('create-users')) abort(403);
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('create-users')) abort(403);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'array',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->input('roles', []));
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        if (!auth()->user()->can('edit-users')) abort(403);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->can('edit-users')) abort(403);
        $request->validate([
            'roles' => 'array',
            'permissions' => 'array',
        ]);
        $user->syncRoles($request->input('roles', []));
        $user->syncPermissions($request->input('permissions', []));
        return redirect()->route('users.index')->with('success', 'User roles and permissions updated.');
    }
} 