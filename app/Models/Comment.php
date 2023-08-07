<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    /**
     * This is a relationship to post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * This is a relationship to user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
