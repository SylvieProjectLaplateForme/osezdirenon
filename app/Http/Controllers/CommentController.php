<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{
   public function store(Request $request, Article $article)
{
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    Comment::create([
        'content' => $request->content,
        'user_id' => auth()->id(),
        'article_id' => $article->id,
        'is_approved' => false,
    ]);

    return back()->with('success', '✅ Commentaire envoyé et en attente de validation.');
}
}
