@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <div class="section-box hero-section text-center">
        <h1 class="display-5 mb-2">🔐 Role Management</h1>
        <p class="lead text-muted mb-3">Manage roles and their associated permissions</p>
        @can('create roles')
        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Create New Role
        </a>
        @endcan
    </div>

    <!-- Roles Table -->
    @if($roles->count() > 0)
        <div class="section-box compact-section">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Users</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-2" style="background: #007aff; color: #fff;">
                                        {{ strtoupper(substr($role->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ ucfirst($role->name) }}</h6>
                                        <small class="text-muted">{{ $role->permissions->count() }} permissions</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $role->users->count() }} users</span>
                            </td>
                            <td>
                                <div class="permission-matrix">
                                    @php
                                        $permissions = $role->permissions->groupBy(function($permission) {
                                            return explode(' ', $permission->name)[1] ?? 'other';
                                        });
                                    @endphp
                                    @foreach($permissions as $resource => $perms)
                                        <div class="mb-1">
                                            <small class="fw-bold text-muted">{{ ucfirst($resource) }}:</small>
                                            @foreach(['view', 'create', 'update', 'delete'] as $action)
                                                @php
                                                    $hasPermission = $perms->contains('name', $action . ' ' . $resource);
                                                @endphp
                                                <span class="badge {{ $hasPermission ? 'bg-success' : 'bg-secondary' }} me-1">
                                                    {{ $hasPermission ? '✓' : '✗' }} {{ $action }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    @can('update', $role)
                                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    @endcan
                                    @can('delete', $role)
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to delete this role?')">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($roles->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $roles->links() }}
            </div>
            @endif
        </div>
    @else
        <!-- Empty State -->
        <div class="section-box text-center">
            <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=400&h=300&fit=crop" 
                 alt="No roles yet" class="empty-illustration rounded">
            <h3 class="mb-2">No Roles Found</h3>
            <p class="text-muted mb-3">Start by creating your first role with appropriate permissions!</p>
            @can('create roles')
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Create First Role
            </a>
            @endcan
        </div>
    @endif
</div>
@endsection 