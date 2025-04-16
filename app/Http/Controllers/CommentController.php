<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'author' => 'required|string|max:255',
            'content' => 'required|string|min:5',
        ]);

        // Création du commentaire lié à un article
        Comment::create($validated);

        // Retourner vers l'article avec un message de succès
        return back()->with('success', 'Commentaire ajouté avec succès.');
    }
}

