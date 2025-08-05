@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <div class="section-box text-center mb-5">
        <h1 class="display-4 mb-3">✏️ Edit User</h1>
        <p class="lead text-muted">Update user information and manage role assignments</p>
    </div>

    <!-- User Form -->
    <div class="section-box">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('POST')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">
                            <i class="fas fa-user me-2"></i>Full Name
                        </label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg" 
                               value="{{ old('name', $user->name) }}" placeholder="Enter full name..." required>
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" 
                               value="{{ old('email', $user->email) }}" placeholder="Enter email address..." required>
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">
                            <i class="fas fa-lock me-2"></i>New Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" 
                               placeholder="Leave blank to keep current password">
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-bold">
                            <i class="fas fa-lock me-2"></i>Confirm New Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="form-control form-control-lg" placeholder="Confirm new password">
                    </div>
                </div>
            </div>

            <!-- Roles Section -->
            <div class="mb-4">
                <label class="form-label fw-bold">
                    <i class="fas fa-users-cog me-2"></i>Assign Roles
                </label>
                <div class="row">
                    @foreach($roles as $role)
                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" 
                                   value="{{ $role->id }}" id="role_{{ $role->id }}"
                                   {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="role_{{ $role->id }}">
                                <strong>{{ ucfirst($role->name) }}</strong>
                                <br>
                                <small class="text-muted">
                                    @if($role->name === 'admin')
                                        Full access to all features
                                    @elseif($role->name === 'editor')
                                        Can create and edit articles
                                    @elseif($role->name === 'reader')
                                        Can view articles and comment
                                    @endif
                                </small>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
                @error('roles')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>Update User
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 