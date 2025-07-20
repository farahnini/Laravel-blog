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
                    <th>Name</th>
                    <th>Articles</th>
                    <th>Users</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                @php
                    $perms = $role->permissions->pluck('name');
                    $resources = ['articles', 'users', 'roles'];
                    $actions = ['create', 'edit', 'delete', 'view'];
                @endphp
                <tr>
                    <td class="fw-semibold">{{ ucfirst($role->name) }}</td>
                    @foreach($resources as $res)
                        <td>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    @foreach($actions as $act)
                                        @php $has = $perms->contains("$act-$res"); @endphp
                                        <td class="text-center">
                                            @if($has)
                                                <span class="text-success">&#10003;</span>
                                            @else
                                                <span class="text-danger">&#10007;</span>
                                            @endif
                                            <div class="small text-muted">{{ ucfirst($act) }}</div>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endforeach
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