<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
    'content',
    'user_id',
    'article_id',
    'is_approved',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}
