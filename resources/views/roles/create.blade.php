@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <div class="section-box text-center mb-5">
        <h1 class="display-4 mb-3">🔐 Create New Role</h1>
        <p class="lead text-muted">Define a new role and assign appropriate permissions</p>
    </div>

    <!-- Role Form -->
    <div class="section-box">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="form-label fw-bold">
                    <i class="fas fa-tag me-2"></i>Role Name
                </label>
                <input type="text" name="name" id="name" class="form-control form-control-lg" 
                       value="{{ old('name') }}" placeholder="Enter role name..." required>
                @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Permissions Section -->
            <div class="mb-4">
                <label class="form-label fw-bold">
                    <i class="fas fa-shield-alt me-2"></i>Assign Permissions
                </label>
                
                @php
                    $permissions = $permissions->groupBy(function($permission) {
                        return explode(' ', $permission->name)[1] ?? 'other';
                    });
                @endphp
                
                @foreach($permissions as $resource => $perms)
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-bold">
                            <i class="fas fa-folder me-2"></i>{{ ucfirst($resource) }} Permissions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($perms as $permission)
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" 
                                           value="{{ $permission->id }}" id="perm_{{ $permission->id }}"
                                           {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        <strong>{{ ucfirst(explode(' ', $permission->name)[0]) }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $permission->name }}</small>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                
                @error('permissions')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>Create Role
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 