<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    'slug',
    'content',
    'category_id',
    'user_id',
    'is_approved',
    'keywords',
    'image',
];
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    
    public function comments()
{
    return $this->hasMany(Comment::class);
}
/**
     * Relation : un article appartient à un utilisateur (éditeur)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



