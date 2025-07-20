@extends('layouts.app')
@section('content')
    <section class="section-box" style="max-width: 600px; margin:auto;">
        <div class="mb-4 text-center">
            <h2 class="mb-2" style="font-weight:600; color:#222;">Edit Role</h2>
            <a href="{{ route('roles.index') }}" class="btn btn-info btn-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('roles.update', $role) }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Permissions</label>
                    @php
                        $grouped = collect($permissions)->groupBy(function($perm) {
                            return Str::after($perm->name, '-');
                        });
                    @endphp
                    <div class="row">
                        @foreach($grouped as $group => $perms)
                            <div class="col-md-6 mb-3">
                                <div class="fw-semibold mb-2" style="color:#ff7f50;">{{ ucfirst($group) }}</div>
                                @foreach($perms as $perm)
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="perm_{{ $perm->id }}" {{ $role->permissions->pluck('name')->contains($perm->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perm_{{ $perm->id }}">{{ Str::before($perm->name, '-') }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
    </section>
@endsection 