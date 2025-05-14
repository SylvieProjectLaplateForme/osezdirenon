<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'author' => 'required|string|max:255',
            'content' => 'required|string|min:5',
        ]);

        Comment::create([
            'article_id' => $validated['article_id'],
            'author' => $validated['author'], // ✅ CORRECT
            'content' => $validated['content'],
            'is_approved' => 0, // commentaire en attente
        ]);

        return redirect()->back()->with('success', 'Merci ! Votre commentaire est en attente de validation.');
    }
}
