@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <div class="section-box hero-section text-center">
        <h1 class="display-5 mb-2">👥 User Management</h1>
        <p class="lead text-muted mb-3">Manage users and their roles across the platform</p>
        @can('create users')
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>Add New User
        </a>
        @endcan
    </div>

    <!-- Users Table -->
    @if($users->count() > 0)
        <div class="section-box compact-section">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-2">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted">{{ $user->email }}</span>
                            </td>
                            <td>
                                @if($user->roles->count() > 0)
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-primary me-1">{{ $role->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No roles assigned</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    @can('update', $user)
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    @endcan
                                    @can('delete', $user)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to delete this user?')">
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
            @if($users->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    @else
        <!-- Empty State -->
        <div class="section-box text-center">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=300&fit=crop" 
                 alt="No users yet" class="empty-illustration rounded">
            <h3 class="mb-2">No Users Found</h3>
            <p class="text-muted mb-3">Start building your community by adding the first user!</p>
            @can('create users')
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus me-2"></i>Add First User
            </a>
            @endcan
        </div>
    @endif
</div>
@endsection

@section('scripts')
    @parent
    <script>
        // This script is for the avatar-circle styling, which is now handled by CSS classes.
        // Keeping it for now, but it might become redundant if CSS is sufficient.
        document.addEventListener('DOMContentLoaded', function() {
            const avatarCircles = document.querySelectorAll('.avatar-circle');
            avatarCircles.forEach(circle => {
                const text = circle.textContent.trim();
                if (text.length > 0) {
                    circle.textContent = text;
                } else {
                    circle.textContent = '?'; // Fallback for empty text
                }
            });
        });
    </script>
@endsection 