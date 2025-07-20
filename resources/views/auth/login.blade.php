@extends('layouts.app')
@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 80vh; background: linear-gradient(135deg, #fffbe9 0%, #e0f7fa 100%); position:relative;">
    <div class="col-md-10 col-lg-6">
        <section class="p-5 mb-4 shadow-lg" style="background:#fff; border:2px solid #ffe5b4; border-radius:1.5rem; box-shadow:0 4px 24px rgba(44,62,80,0.10);">
            <div class="text-center pb-3">
                <i class="bi bi-person-circle display-2 mb-2" style="color:#00bcd4;"></i>
                <h2 class="mb-1 fw-bold" style="color:#ff7f50; letter-spacing:1px;">Sign In</h2>
                <div class="text-muted mb-2">Welcome back! Please sign in to your account.</div>
            </div>
            <div class="alert alert-info text-center mb-4" style="background:#e0f7fa; color:#00796b; border:none;">
                <strong>Demo Logins:</strong><br>
                <span class="badge bg-secondary">admin@example.com / password</span>
                <span class="badge bg-secondary">editor@example.com / password</span>
                <span class="badge bg-secondary">reader@example.com / password</span>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control blog-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="you@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control blog-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg" style="background:#00bcd4; border:none; font-weight:600;">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </div>
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="small text-decoration-none" href="{{ route('password.request') }}">
                            <i class="bi bi-question-circle"></i> Forgot Your Password?
                        </a>
                    </div>
                @endif
            </form>
        </section>
    </div>
</div>
<style>
    .blog-input {
        background: #fffdf8;
        color: #3d2c1e;
        border: 1.5px solid #f3e6c4;
        border-radius: 0.5rem;
        font-family: 'Roboto', sans-serif;
    }
    .blog-input:focus {
        border-color: #00bcd4;
        background: #fffdf8;
        color: #3d2c1e;
        box-shadow: 0 0 0 0.2rem rgba(0,188,212,0.10);
    }
</style>
@endsection
