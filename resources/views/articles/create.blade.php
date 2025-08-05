@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <div class="section-box text-center mb-5">
        <h1 class="display-4 mb-3">✍️ Write New Article</h1>
        <p class="lead text-muted">Share your knowledge, insights, and stories with our community</p>
    </div>

    <!-- Article Form -->
    <div class="section-box">
        <form action="{{ route('articles.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="title" class="form-label fw-bold">
                    <i class="fas fa-heading me-2"></i>Article Title
                </label>
                <input type="text" name="title" id="title" class="form-control form-control-lg" 
                       value="{{ old('title') }}" placeholder="Enter a compelling title..." required>
                @error('title')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="form-label fw-bold">
                    <i class="fas fa-edit me-2"></i>Article Content
                </label>
                <div id="editor" style="height: 400px; border-radius: 0.7rem; border: 1.5px solid #e5e5e5;">
                    {!! old('content') !!}
                </div>
                <input type="hidden" name="content" id="content">
                @error('content')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-paper-plane me-2"></i>Publish Article
                </button>
                <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Quill.js -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        },
        placeholder: 'Start writing your article here...'
    });

    // Update hidden input before form submission
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('content').value = quill.root.innerHTML;
    });
</script>
@endsection 