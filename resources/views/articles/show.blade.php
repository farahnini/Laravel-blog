@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Article Hero -->
    <div class="section-box compact-section">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h1 class="display-6 mb-2">{{ $article->title }}</h1>
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar-circle me-2">
                        {{ strtoupper(substr($article->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $article->user->name }}</h6>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>Created {{ $article->created_at->diffForHumans() }}
                            @if($article->updated_at != $article->created_at)
                                <br><i class="fas fa-edit me-1"></i>Updated {{ $article->updated_at->diffForHumans() }}
                            @endif
                        </small>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                @endcan
                @can('delete', $article)
                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </form>
                @endcan
            </div>
        </div>

        <!-- Article Content -->
        <div class="article-content mb-3">
            {!! $article->content !!}
        </div>

        <!-- Reactions -->
        <div class="d-flex align-items-center justify-content-between border-top pt-3">
            <div class="d-flex align-items-center gap-3">
                <form action="{{ route('articles.like', $article) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-thumbs-up me-1"></i>
                        {{ $article->reactions()->where('type', 'like')->count() }}
                    </button>
                </form>
                
                <form action="{{ route('articles.dislike', $article) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-thumbs-down me-1"></i>
                        {{ $article->reactions()->where('type', 'dislike')->count() }}
                    </button>
                </form>
            </div>
            
            <a href="#comments" class="btn btn-outline-info btn-sm">
                <i class="fas fa-comments me-1"></i>
                {{ $article->comments()->count() }} Comments
            </a>
        </div>
    </div>

    <!-- Comments Section -->
    <div id="comments" class="section-box compact-section">
        <h3 class="mb-3">
            <i class="fas fa-comments me-2"></i>Comments
        </h3>

        <!-- Add Comment -->
        @auth
        <div class="mb-3">
            <form action="{{ route('articles.comments.store', $article) }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label for="content" class="form-label fw-bold">Add a comment</label>
                    <textarea name="content" id="content" rows="2" class="form-control" 
                              placeholder="Share your thoughts..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-paper-plane me-1"></i>Post Comment
                </button>
            </form>
        </div>
        @endauth

        <!-- Comments List -->
        @if($article->comments->count() > 0)
            <div class="comments-list">
                @foreach($article->comments as $comment)
                <div class="comment-item border-bottom pb-2 mb-2">
                    <div class="d-flex align-items-start">
                        <div class="avatar-circle me-2 mt-1">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $comment->user->name }}</h6>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    @can('update', $comment)
                                    <a href="{{ route('articles.comments.edit', [$article, $comment]) }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('delete', $comment)
                                    <form action="{{ route('articles.comments.delete', [$article, $comment]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this comment?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            <p class="mb-0">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-3">
                <i class="fas fa-comments fa-2x text-muted mb-2"></i>
                <p class="text-muted mb-0">No comments yet. Be the first to share your thoughts!</p>
            </div>
        @endif
    </div>

    <!-- Back to Articles -->
    <div class="text-center">
        <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to Articles
        </a>
    </div>
</div>
@endsection 