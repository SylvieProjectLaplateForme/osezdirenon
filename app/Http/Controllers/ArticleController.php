<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Affiche la liste des articles avec recherche possible
     */
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->get();

        return view('home', compact('articles'));
    }

    /**
     * Affiche le détail d'un article
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('article', compact('article'));
    }

    /**
     * Stocke un commentaire pour un article donné
     */
    public function storeComment(Request $request, Article $article)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string|min:5',
        ]);

        $article->comments()->create($validated);

        return redirect()->route('article.show', $article->slug)
                         ->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * Supprime un article (réservé à l'admin)
     */
    public function delete($id)
    {
        if (!Auth::check() || Auth::user()->role->name !== 'admin') {
            abort(403, 'Accès interdit.');
        }

        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('home')->with('success', 'Article supprimé avec succès.');
    }
}
