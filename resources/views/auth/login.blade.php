@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <!-- Login Hero -->
            <div class="section-box hero-section text-center">
                <h1 class="display-5 mb-2">🔐 Welcome Back</h1>
                <p class="lead text-muted mb-3">Sign in to access your account</p>
            </div>

            <!-- Login Form -->
            <div class="section-box compact-section">
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="{{ old('email') }}" placeholder="Enter your email..." required autofocus>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control" 
                               placeholder="Enter your password..." required>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </div>
                </form>

                <!-- Demo Credentials -->
                <div class="p-3 bg-light rounded">
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-info-circle me-2"></i>Demo Credentials
                    </h6>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted">Admin:</small><br>
                            <code>admin@example.com</code><br>
                            <code>password</code>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Editor:</small><br>
                            <code>editor@example.com</code><br>
                            <code>password</code>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Reader:</small><br>
                            <code>reader@example.com</code><br>
                            <code>password</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
