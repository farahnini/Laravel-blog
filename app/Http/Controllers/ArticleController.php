<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ArticleComment;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::with('user')->orderByDesc('created_at')->paginate(6);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $user = auth()->user();
        if ($article->user_id !== $user->id) {
            abort(403);
        }
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $article->update($request->only('title', 'content'));
        return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        $user = auth()->user();
        if ($article->user_id !== $user->id) {
            abort(403);
        }
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }

    public function commentsStore(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        ArticleComment::create([
            'article_id' => $article->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        return back()->with('success', 'Comment posted!');
    }

    public function commentDelete(Article $article, ArticleComment $comment)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }
        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }

    public function commentEdit(Article $article, ArticleComment $comment)
    {
        $user = auth()->user();
        if ($user->id !== $comment->user_id && !$user->hasRole('admin')) {
            abort(403);
        }
        return view('articles.comment_edit', compact('article', 'comment'));
    }

    public function commentUpdate(Request $request, Article $article, ArticleComment $comment)
    {
        $user = auth()->user();
        if ($user->id !== $comment->user_id && !$user->hasRole('admin')) {
            abort(403);
        }
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $comment->content = $request->content;
        $comment->save();
        return redirect()->route('articles.show', $article)->with('success', 'Comment updated.');
    }

    public function reactionLike(Article $article)
    {
        $user = auth()->user();
        $existing = $article->reactions()->where('user_id', $user->id)->first();
        if ($existing && $existing->type === 'like') {
            $existing->delete();
        } else {
            $article->reactions()->updateOrCreate(
                ['user_id' => $user->id],
                ['type' => 'like']
            );
        }
        return back();
    }

    public function reactionDislike(Article $article)
    {
        $user = auth()->user();
        $existing = $article->reactions()->where('user_id', $user->id)->first();
        if ($existing && $existing->type === 'dislike') {
            $existing->delete();
        } else {
            $article->reactions()->updateOrCreate(
                ['user_id' => $user->id],
                ['type' => 'dislike']
            );
        }
        return back();
    }
} 