<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Publicite;
use App\Models\Category;
use App\Models\Comment;

class EditeurController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $userId = auth()->id();

        // Articles
        $articles = Article::with('user', 'category')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        $articlesValides = $articles->where('is_approved', true);
        $articlesEnAttente = $articles->where('is_approved', false);

        // Publicités
        $pubsValidees = Publicite::where('user_id', $userId)->where('approved', 1)->get();
        $pubsAttente = Publicite::where('user_id', $userId)->where('approved', 0)->get();
        $pubsPayees = Publicite::where('user_id', $userId)->where('paid', 1)->get();

        // Commentaires en attente
        $commentsEnAttente = Comment::whereHas('article', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('is_approved', 0)->count();

        // Graphique
        $months = ['Janv', 'Fév', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'];
        $articlesPerMonth = collect(range(1, 12))->map(function ($month) use ($userId) {
            return Article::where('user_id', $userId)
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $month)
                ->count();
        });

        return view('editeur.dashboard', compact(
            'articles',
            'articlesValides',
            'articlesEnAttente',
            'pubsValidees',
            'pubsAttente',
            'pubsPayees',
            'commentsEnAttente',
            'months',
            'articlesPerMonth'
        ));
    }
    // Afficher MES ARTICLES pour l'éditeur connecté
public function mesArticles()
{
    $articles = Article::where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('editeur.mesArticles', compact('articles'));
}


    // Articles en attente
    public function articlesEnAttente()
    {
        $articlesEnAttente = Article::where('user_id', auth()->id())
            ->where('is_approved', false)
            ->latest()
            ->get();

        return view('editeur.articlesEnAttente', compact('articlesEnAttente'));
    }

    // Créer un article
    public function create()
    {
        $categories = Category::all();
        return view('editeur.articleCreate', compact('categories'));
    }

    public function publicitesPayees()
{
    $userId = Auth::id();

    $publicites = Publicite::where('user_id', $userId)
        ->where('paid', true)
        ->get();

    return view('editeur.publicitesPayees', compact('publicites'));
}
}
