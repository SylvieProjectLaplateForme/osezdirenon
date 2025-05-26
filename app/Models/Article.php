<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    /**
     * ✅ L’article appartient à une catégorie
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * ✅ L’article a plusieurs commentaires
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * ✅ L’article est rédigé par un utilisateur (éditeur)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ✅ Formatage du contenu avec sécurité et mise en forme HTML minimale
     */
    public function getFormattedContentAttribute()
    {
        return nl2br(e(strip_tags($this->content, '<p><br><strong><em><ul><ol><li><a>')));
    }
}
