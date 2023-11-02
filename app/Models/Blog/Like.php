<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    // Getters
    public function author()
    {
        return $this -> belongsTo(User::class, 'user_id');
    }

    public function likeable()
    {
        return $this -> morphTo();
    }
}
