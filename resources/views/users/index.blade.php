@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">User Management</h2>
        @can('create-users')
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
        @endcan
    </div>
    <section class="section-box">
        @if($users->count())
        <div class="container bg-body rounded shadow-sm p-4">
            <h2 class="mb-4 fw-semibold text-body">Users</h2>
            <table class="table table-hover align-middle mb-0 bg-body rounded">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><span class="avatar-circle">{{ strtoupper(substr($user->name, 0, 1)) }}</span> {{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td>
                            @can('edit-users')
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-info btn-sm">Edit</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $users->links() }}</div>
        </div>
        @else
        <div class="text-center py-5">
            <img src="https://undraw.co/api/illustrations/undraw_team_spirit_re_yl1v.svg" alt="No users" style="max-width:220px; margin-bottom:1.5rem;">
            <h4 class="mt-3">No users found.</h4>
            <p class="text-muted">Start by adding a new user.</p>
        </div>
        @endif
    </section>
    <style>
        .avatar-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #f5f5f5;
            color: #222;
            font-weight: 600;
            font-size: 1rem;
        }
        body.dark-mode .avatar-circle {
            background: #23272b;
            color: #f1f1f1;
        }
    </style>
@endsection 