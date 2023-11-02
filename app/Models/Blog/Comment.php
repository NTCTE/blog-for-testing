<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'post_id',
        'user_id',
        'comment_id',
    ];

    // Getters
    public function author()
    {
        return $this -> belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this -> belongsTo(Post::class, 'post_id');
    }

    public function parent()
    {
        return $this -> belongsTo(Comment::class, 'comment_id');
    }

    public function children()
    {
        return $this -> hasMany(Comment::class, 'comment_id');
    }

    public function likes()
    {
        return $this -> morphMany(Like::class, 'likeable');
    }
}
