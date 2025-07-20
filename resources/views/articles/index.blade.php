@extends('layouts.app')
@section('content')
    <div class="mb-4" style="border-radius:1rem; overflow:hidden;">
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80" alt="Blog Banner" style="width:100%; max-height:260px; object-fit:cover;">
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Articles</h1>
        @can('create-articles')
            <a href="{{ route('articles.create') }}" class="btn btn-primary">New Article</a>
        @endcan
    </div>
    <section class="section-box">
        @if($articles->count())
            <div class="row g-4">
                @foreach ($articles as $article)
                    <div class="col-md-6 col-lg-4">
                        <div class="p-4 mb-3 h-100 d-flex flex-column justify-content-between" style="background:#fff; border:1px solid #e5e5e5; border-radius:1rem;">
                            <div>
                                <h5 class="mb-2" style="font-weight:600; color:#222;">
                                    <a href="{{ route('articles.show', $article) }}" class="text-decoration-none" style="color:#007aff;">{{ $article->title }}</a>
                                </h5>
                                <div class="mb-2 text-muted small">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }} <a href="{{ route('articles.show', $article) }}" class="ms-1" style="color:#007aff;">Read more</a></div>
                                <div class="mb-2 d-flex align-items-center gap-2">
                                    <span class="badge {{ $article->userReaction(auth()->user()) === 'like' ? 'bg-primary' : 'bg-light text-dark' }}">👍 {{ $article->likeCount() }}</span>
                                    <span class="badge {{ $article->userReaction(auth()->user()) === 'dislike' ? 'bg-danger' : 'bg-light text-dark' }}">👎 {{ $article->dislikeCount() }}</span>
                                </div>
                                <div class="mb-2 d-flex align-items-center gap-2 text-muted small">
                                    <span class="avatar-circle">{{ strtoupper(substr($article->user->name ?? 'U', 0, 1)) }}</span>
                                    <span>{{ $article->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2 text-muted small">
                                    {{ $article->created_at->format('M d, Y') }}
                                </div>
                            </div>
                            <div class="mt-3 d-flex gap-2">
                                @if(auth()->check() && $article->user_id === auth()->id())
                                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-info btn-sm" title="Edit your article">Edit</a>
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this article?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete your article">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">{{ $articles->links() }}</div>
        @else
            <div class="text-center py-5">
                <img src="https://undraw.co/api/illustrations/undraw_empty_re_opql.svg" alt="No articles" style="max-width:220px; margin-bottom:1.5rem;">
                <h4 class="mt-3">No articles found.</h4>
                <p class="text-muted">Start by creating a new article.</p>
            </div>
        @endif
    </section>
    <style>
        .avatar-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f5f5f5;
            color: #222;
            font-weight: 600;
            font-size: 1.1rem;
        }
    </style>
@endsection 