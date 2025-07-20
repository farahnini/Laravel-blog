@extends('layouts.app')
@section('content')
    <section class="section-box" style="max-width: 700px; margin:auto;">
        <div class="mb-4 text-center">
            <h2 class="mb-2" style="font-weight:600; color:#222;">Create Article</h2>
            <a href="{{ route('articles.index') }}" class="btn btn-info btn-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('articles.store') }}" id="article-form">
            @csrf
            <div class="mb-4">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control blog-input" value="{{ old('title') }}" required autofocus placeholder="Article title...">
            </div>
            <div class="mb-4">
                <label class="form-label">Content <span class="text-muted small">(Rich text supported)</span></label>
                <div id="quill-editor" style="height: 320px;">{!! old('content') !!}</div>
                <input type="hidden" name="content" id="content-input">
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100">Save</button>
        </form>
    </section>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        var quill = new Quill('#quill-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'blockquote', 'code-block'],
                    ['clean']
                ]
            }
        });
        document.getElementById('article-form').onsubmit = function() {
            document.getElementById('content-input').value = quill.root.innerHTML;
        };
    </script>
@endsection 