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
        'slug',
        'category_id',
        'keywords',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}

}

