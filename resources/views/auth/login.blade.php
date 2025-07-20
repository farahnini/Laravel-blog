@extends('layouts.app')
@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-10 col-lg-6">
        <section class="p-5 mb-4" style="background:#fffdf8; border:1.5px solid #f3e6c4; border-radius:1rem; box-shadow:0 2px 8px rgba(44,62,80,0.07);">
            <div class="text-center pb-3">
                <i class="bi bi-person-circle display-3 mb-2" style="color:#a67c52;"></i>
                <h3 class="mb-0">Login</h3>
                <div class="text-muted small">Welcome back! Please sign in to your account.</div>
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
                    <button type="submit" class="btn btn-primary btn-lg">
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
        border-color: #d4a373;
        background: #fffdf8;
        color: #3d2c1e;
    }
</style>
@endsection
