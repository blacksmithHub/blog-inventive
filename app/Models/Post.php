<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body'
    ];

    /**
     * This is a relationship to user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * This is a relationship to comment
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
