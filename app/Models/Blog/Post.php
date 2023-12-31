<?php

namespace App\Models\Blog;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'body',
        'amount',
        'is_draft',
        'is_paid',
        'user_id',
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'is_paid' => 'boolean',
    ];

    // Getters
    public function author()
    {
        return $this -> belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this -> hasMany(Comment::class, 'post_id');
    }

    public function likes()
    {
        return $this -> morphMany(Like::class, 'likeable');
    }

    public function is_paid()
    {
        return boolval(Invoice::where('payable_type', Post::class)
            -> where('payable_id', $this -> id)
            -> where('status', 'paid')
            -> where('user_id', auth() -> id())
            -> count()) || $this -> is_paid;
    }
}
