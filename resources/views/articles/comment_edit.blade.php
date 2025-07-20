@extends('layouts.app')
@section('content')
    <section class="section-box" style="max-width: 600px; margin:auto;">
        <div class="mb-4 text-center">
            <h2 class="mb-2" style="font-weight:600; color:#222;">Edit Comment</h2>
            <a href="{{ route('articles.show', $article) }}" class="btn btn-info btn-sm">Back to Article</a>
        </div>
        <form method="POST" action="{{ route('articles.comments.update', [$article, $comment]) }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Comment</label>
                <textarea name="content" class="form-control blog-input" rows="4" required>{{ old('content', $comment->content) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        </form>
    </section>
@endsection 