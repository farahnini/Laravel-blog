@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <!-- Error Hero -->
            <div class="section-box">
                <div class="mb-4">
                    <i class="fas fa-exclamation-triangle fa-5x text-warning mb-4"></i>
                    <h1 class="display-1 fw-bold text-warning mb-3">403</h1>
                    <h2 class="display-5 mb-3">Access Forbidden</h2>
                    <p class="lead text-muted mb-4">
                        Sorry, you don't have permission to access this resource. 
                        Please contact an administrator if you believe this is an error.
                    </p>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-home me-2"></i>Go Home
                    </a>
                    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-newspaper me-2"></i>Browse Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 