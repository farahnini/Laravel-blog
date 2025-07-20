@extends('layouts.app')
@section('content')
    <section class="section-box bg-body rounded shadow-sm" style="max-width: 600px; margin:auto;">
        <div class="mb-4 text-center">
            <h2 class="mb-2 fw-semibold text-body">Create User</h2>
            <a href="{{ route('users.index') }}" class="btn btn-info btn-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Roles</label>
                <div class="row">
                    @foreach($roles as $role)
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}">
                                <label class="form-check-label" for="role_{{ $role->id }}">{{ ucfirst($role->name) }}</label>
                            </div>
                            @php
                                $perms = $role->permissions->pluck('name');
                                $grouped = collect($perms)->groupBy(function($perm) { return Str::after($perm, '-'); });
                            @endphp
                            @if($grouped->count())
                                <div class="small text-muted ms-4">
                                    <strong>Permissions:</strong>
                                    <ul class="mb-1">
                                        @foreach($grouped as $group => $actions)
                                            <li>{{ ucfirst($group) }}: {{ $actions->map(fn($p) => Str::before($p, '-'))->unique()->implode(', ') }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Create</button>
        </form>
    </section>
@endsection 