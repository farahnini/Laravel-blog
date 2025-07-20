@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Role Management</h2>
        @can('create-roles')
            <a href="{{ route('roles.create') }}" class="btn btn-primary">New Role</a>
        @endcan
    </div>
    <div class="container bg-body rounded shadow-sm p-4">
        <h2 class="mb-4 fw-semibold text-body">Roles</h2>
        <table class="table table-hover align-middle mb-0 bg-body rounded">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->permissions->pluck('name')->join(', ') }}</td>
                    <td>
                        @can('edit-roles')
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-info btn-sm">Edit</a>
                        @endcan
                        @can('delete-roles')
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this role?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection 