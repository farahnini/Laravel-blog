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
                <select name="roles[]" class="form-select" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Create</button>
        </form>
    </section>
@endsection 