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
        'content' => 'required|string',
    ]);

    Comment::create([
        'article_id' => $validated['article_id'],
        'author' => $validated['author'],
        'content' => $validated['content'],
        'is_approved' => 0, // Le commentaire doit être validé avant d’apparaître
    ]);

    return redirect()->back()->with('success', 'Merci ! Votre commentaire sera vérifié avant publication.');
}



      

        
    }


