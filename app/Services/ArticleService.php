<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ArticleService
{
    /**
     * Crée un nouvel article depuis une requête
     */
    public function createArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        //  Gestion de l'image (optionnelle)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        //  Slug unique
        $slug = Str::slug($validated['title']);
        if (Article::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        //  Création
        Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
            'is_approved' => false,
            'image' => $imagePath,
        ]);
    }

    /**
     * Met à jour un article existant
     */
    public function updateArticle(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        //  Image si nouvelle
        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
        }

        //  Mise à jour
        $article->title = $validated['title'];
        $article->content = $validated['content'];
        $article->category_id = $validated['category_id'];
        $article->save();
    }
}
