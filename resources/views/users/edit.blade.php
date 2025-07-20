@extends('layouts.app')
@section('content')
    <section class="section-box bg-body rounded shadow-sm" style="max-width: 600px; margin:auto;">
        <div class="mb-4 text-center">
            <h2 class="mb-2 fw-semibold text-body">Edit User</h2>
            <a href="{{ route('users.index') }}" class="btn btn-info btn-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Name</label>
                <input type="text" class="form-control blog-input" value="{{ $user->name }}" disabled>
            </div>
            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control blog-input" value="{{ $user->email }}" disabled>
            </div>
            <div class="mb-4">
                <label class="form-label">Roles</label>
                <select name="roles[]" class="form-select" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Permissions</label>
                <select name="permissions[]" class="form-select" multiple>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->name }}" {{ $user->permissions->pluck('name')->contains($permission->name) ? 'selected' : '' }}>{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </section>
@endsection 