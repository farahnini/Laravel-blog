@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <div class="section-box hero-section text-center">
        <h1 class="display-5 mb-2">📚 Our Blog</h1>
        <p class="lead text-muted mb-3">Discover amazing stories, insights, and knowledge shared by our community</p>
        @can('create articles')
        <a href="{{ route('articles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Write New Article
        </a>
        @endcan
    </div>

    <!-- Articles Grid -->
    @if($articles->count() > 0)
        <div class="card-grid">
            @foreach($articles as $article)
            <div class="section-box compact-section d-flex flex-column">
                <!-- Article Header -->
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar-circle me-2">
                        {{ strtoupper(substr($article->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $article->user->name }}</h6>
                        <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                    </div>
                </div>

                <!-- Article Content -->
                <h5 class="mb-2">
                    <a href="{{ route('articles.show', $article) }}" class="text-decoration-none">
                        {{ $article->title }}
                    </a>
                </h5>
                
                <p class="text-muted mb-3 flex-grow-1">
                    {{ Str::limit(strip_tags($article->content), 100) }}
                </p>

                <!-- Article Footer -->
                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary me-2">
                            <i class="fas fa-thumbs-up me-1"></i>{{ $article->reactions()->where('type', 'like')->count() }}
                        </span>
                        <span class="badge bg-info">
                            <i class="fas fa-comment me-1"></i>{{ $article->comments()->count() }}
                        </span>
                    </div>
                    
                    <div class="btn-group" role="group">
                        <a href="{{ route('articles.show', $article) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Read
                        </a>
                        @can('update', $article)
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="section-box text-center">
            <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=300&fit=crop" 
                 alt="No articles yet" class="empty-illustration rounded">
            <h3 class="mb-2">No Articles Yet</h3>
            <p class="text-muted mb-3">Be the first to share your thoughts and insights with our community!</p>
            @can('create articles')
            <a href="{{ route('articles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Write Your First Article
            </a>
            @endcan
        </div>
    @endif
</div>
@endsection 