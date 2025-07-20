@extends('layouts.app')

@section('title', '403 Forbidden')

@section('content')
<div class="container py-5 text-center" style="background: var(--bs-body-bg, #fff); color: var(--bs-body-color, #222); border-radius: 1rem;">
    <div class="display-1 fw-bold mb-3">403</div>
    <h1 class="mb-3">Forbidden</h1>
    <p class="lead mb-4">Sorry, you do not have permission to access this page.</p>
    <a href="{{ route('articles.index') }}" class="btn btn-primary btn-lg">Go to Home</a>
</div>
@endsection 