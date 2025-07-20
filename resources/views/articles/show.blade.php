@extends('layouts.app')
@section('content')
    @php
        $banners = [
            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1465101178521-c1a9136a3b99?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=900&q=80',
        ];
        $banner = $banners[$article->id % count($banners)];
    @endphp
    <div class="mb-4" style="border-radius:1rem; overflow:hidden;">
        <img src="{{ $banner }}" alt="Article Banner" style="width:100%; max-height:260px; object-fit:cover;">
    </div>
    <section class="section-box" style="max-width: 700px; margin:auto;">
        <div class="mb-4 text-center">
            <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                <form method="POST" action="{{ route('articles.like', $article) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm {{ $article->userReaction(auth()->user()) === 'like' ? 'btn-primary' : 'btn-info' }}" style="min-width:60px;">👍 {{ $article->likeCount() }}</button>
                </form>
                <form method="POST" action="{{ route('articles.dislike', $article) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm {{ $article->userReaction(auth()->user()) === 'dislike' ? 'btn-danger' : 'btn-info' }}" style="min-width:60px;">👎 {{ $article->dislikeCount() }}</button>
                </form>
            </div>
            <h2 class="mb-2" style="font-weight:600; color:#222;">{{ $article->title }}</h2>
            <div class="d-flex justify-content-center align-items-center gap-2 text-muted small mb-2">
                <span class="avatar-circle">{{ strtoupper(substr($article->user->name ?? 'U', 0, 1)) }}</span>
                <span>{{ $article->user->name ?? 'N/A' }}</span>
            </div>
            <div class="text-muted small mb-2">
                Created: {{ $article->created_at->format('M d, Y H:i') }} <span title="{{ $article->created_at }}">({{ $article->created_at->diffForHumans() }})</span><br>
                Updated: {{ $article->updated_at->format('M d, Y H:i') }} <span title="{{ $article->updated_at }}">({{ $article->updated_at->diffForHumans() }})</span>
            </div>
            <a href="{{ route('articles.index') }}" class="btn btn-info btn-sm">Back</a>
        </div>
        <div class="mb-4" style="font-size:1.15rem; line-height:1.7; color:#222;">{!! $article->content !!}</div>
        <div class="d-flex gap-2 mb-4">
            @if(auth()->check() && (auth()->id() === $article->user_id))
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-info btn-sm">Edit</a>
                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this article?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endif
        </div>
        <hr>
        <div class="mb-3"><strong>Comments</strong></div>
        @auth
        <form method="POST" action="{{ route('articles.comments.store', $article) }}" class="mb-4">
            @csrf
            <div class="mb-2">
                <textarea name="content" class="form-control blog-input" rows="3" required placeholder="Add a comment..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
        </form>
        @endauth
        @if($article->comments->count())
            <div class="mt-3">
                @foreach($article->comments->sortByDesc('created_at') as $comment)
                    <div class="mb-3 p-2" style="background:#f8f8f8; border-radius:0.5rem;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="avatar-circle" style="width:24px;height:24px;font-size:0.95rem;">{{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}</span>
                            <span class="fw-semibold">{{ $comment->user->name ?? 'N/A' }}</span>
                            <span class="text-muted small ms-2">{{ $comment->created_at->format('M d, Y H:i') }} ({{ $comment->created_at->diffForHumans() }})</span>
                            @if(auth()->check() && auth()->id() === $comment->user_id)
                                <a href="{{ route('articles.comments.edit', [$article, $comment]) }}" class="btn btn-info btn-sm ms-2" style="padding:2px 10px;font-size:0.85em;">Edit</a>
                            @endif
                            @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->user()->hasRole('admin')))
                                <form method="POST" action="{{ route('articles.comments.delete', [$article, $comment]) }}" class="ms-1 d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" style="padding:2px 10px;font-size:0.85em;">Delete</button>
                                </form>
                            @endif
                        </div>
                        <div style="margin-left:2.2rem;">{!! nl2br(e($comment->content)) !!}</div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-muted">No comments yet.</div>
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