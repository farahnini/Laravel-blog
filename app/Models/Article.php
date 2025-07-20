<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions()
    {
        return $this->hasMany(ArticleReaction::class);
    }

    public function comments()
    {
        return $this->hasMany(ArticleComment::class);
    }

    public function likeCount()
    {
        return $this->reactions()->where('type', 'like')->count();
    }

    public function dislikeCount()
    {
        return $this->reactions()->where('type', 'dislike')->count();
    }

    public function userReaction($user)
    {
        if (!$user) return null;
        $reaction = $this->reactions()->where('user_id', $user->id)->first();
        return $reaction ? $reaction->type : null;
    }
} 