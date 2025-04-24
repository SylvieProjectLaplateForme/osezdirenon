<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard($filter = null)
    {
        $articles = Article::with('user', 'category')->latest();

        if ($filter === 'valide') {
            $articles->where('is_approved', 1);
        } elseif ($filter === 'attente') {
            $articles->where('is_approved', 0);
        }

// $commentsEnAttente = Comment::where('is_approved', 0)->count();
// Statistiques existantes
$total = Article::count();
$valides = Article::where('is_approved', true)->count();
$attente = Article::where('is_approved', false)->count();
$commentsEnAttente = Comment::where('is_approved', false)->count();



    // Requête compatible SQLite pour compter les articles par mois
    $articlesPerMonth = Article::selectRaw("strftime('%m', created_at) as month, COUNT(*) as count")
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

    $monthlyCounts = collect(range(1, 12))->map(function ($month) use ($articlesPerMonth) {
        $formatted = str_pad($month, 2, '0', STR_PAD_LEFT);
        return $articlesPerMonth->get($formatted, 0);
    });

    return view('dashboard', [
        'total' => $total,
        'valides' => $valides,
        'attente' => $attente,
        'commentsEnAttente' => $commentsEnAttente,
        'months' => ['Janv', 'Fév', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
        'articlesPerMonth' => $monthlyCounts,
        // 'articles' => Article::with('user')->latest()->take(10)->get(),
        'articles' => $articles->take(10)->get(),
    ]);
}


    public function articlesEnAttente()
    {
        $articles = Article::where('is_approved', 0)->with('user', 'category')->get();
        return view('pendingArticle', compact('articles'));
    }

    public function showArticle($id)
    {
        $article = Article::with('user', 'category')->findOrFail($id);
        return view('show', compact('article'));
    }

    public function validerArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->is_approved = 1;
        $article->save();

        return redirect()->route('admin.articles.pending')->with('success', 'Article validé avec succès.');
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Article supprimé avec succès.');
    }

    public function commentairesEnAttente()
    
{
    $commentaires = \App\Models\Comment::where('is_approved', 0)->with('article')->latest()->get();
    //creation commentpending.blade.php
    return view('commentPending', compact('commentaires'));
}

    public function validateComment($id)
{
    $comment = Comment::findOrFail($id);
    $comment->is_approved = true;
    $comment->save();

    return redirect()->back()->with('success', 'Commentaire validé avec succès.');
}

}
