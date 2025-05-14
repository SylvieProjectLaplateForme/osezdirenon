<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Publicite;

class AdminController extends Controller
{
    // DASHBOARD
    public function dashboard($filter = null)
    {
        $articles = Article::with('user', 'category')->latest();

        if ($filter === 'valide') {
            $articles->where('is_approved', 1);
        } elseif ($filter === 'attente') {
            $articles->where('is_approved', 0);
        }

        $total = Article::count();
        $valides = Article::where('is_approved', true)->count();
        $attente = Article::where('is_approved', false)->count();
        $commentsEnAttente = Comment::where('is_approved', false)->count();
        $totalPublicites = Publicite::count();
        $publicitesEnAttente = Publicite::where('is_approved', false)->count();


        $articlesPerMonth = Article::selectRaw("strftime('%m', created_at) as month, COUNT(*) as count")
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $monthlyCounts = collect(range(1, 12))->map(function ($month) use ($articlesPerMonth) {
            return $articlesPerMonth->get(str_pad($month, 2, '0', STR_PAD_LEFT), 0);
        });

        return view('admin.dashboard', [
            'total' => $total,
            'valides' => $valides,
            'attente' => $attente,
            'commentsEnAttente' => $commentsEnAttente,
            'months' => ['Janv', 'Fév', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
            'articlesPerMonth' => $monthlyCounts,
            'articles' => $articles->take(10)->get(),
            'totalPublicites'=> $totalPublicites,
            'publicitesEnAttente'=> $publicitesEnAttente,
        ]);
    }
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
    
        return back()->with('success', 'Commentaire supprimé.');
    }

    // ✅ LISTE - Tous les articles
    public function articlesIndex()
    {
        $articles = Article::with('user', 'category')->latest()->paginate(15);
        return view('admin.articlesIndex', compact('articles'));
    }

    // ✅ LISTE - Articles validés
    public function articlesValides()
{
    $articles = Article::where('is_approved', true)->latest()->paginate(15);

    return view('admin.articlesIndex', compact('articles'));
}


    // ✅ LISTE - Articles en attente
    public function articlesEnAttente()
    {
        // $articles = Article::where('is_approved', false)->latest()->get();
        // return view('admin.articlesIndex', compact('articles'));
        $articles = Article::where('is_approved', false)->latest()->paginate(15);
        return view('admin.articlesIndex', compact('articles'));
    }

    // ✅ AFFICHAGE - Article
    public function showArticle($id)
    {
        $article = Article::with('user', 'category')->findOrFail($id);
        return view('show', compact('article'));
    }

    // ✅ VALIDER - Article
    public function validerArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->is_approved = 1;
        $article->save();

        return redirect()->back()->with('success', 'Article validé avec succès.');
    }

    // ✅ SUPPRIMER - Article
    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->back()->with('success', 'Article supprimé avec succès.');
    }

    // ✅ COMMENTAIRES EN ATTENTE
    public function commentairesEnAttente()
    {
        $commentaires = Comment::where('is_approved', 0)->with('article')->latest()->get();
        return view('commentPending', compact('commentaires'));
    }

    // ✅ VALIDER COMMENTAIRE
    public function validateComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_approved = true;
        $comment->save();

        return redirect()->back()->with('success', 'Commentaire validé avec succès.');
    }
    public function listeEditeurs()
{
    // Récupérer les utilisateurs dont le rôle est 'editeur'
    $editeurs = User::whereHas('role', function($query) {
        $query->where('name', 'editeur');
    })->get();

    return view('admin.editeurs.index', compact('editeurs'));
}
// ✅ Toutes les publicités
public function publicites()
{
    $publicites = Publicite::latest()->get();
    return view('admin.publicites.index', compact('publicites'));
}

// ✅ Publicités en attente
public function publicitesEnAttente()
{
    $publicites = Publicite::where('is_approved', false)->latest()->get();
    return view('admin.publicites.attente', compact('publicites'));
}

// ✅ Valider une publicité
public function validerPublicite($id)
{
    $pub = Publicite::findOrFail($id);
    $pub->is_approved = true;
    $pub->save();

    return redirect()->back()->with('success', 'Publicité validée avec succès.');
}
public function showPublicite($id)
{
    $pub = \App\Models\Publicite::with('user')->findOrFail($id);
    return view('admin.publicites.show', compact('pub'));
}

// ✅ Supprimer une publicité
public function supprimerPublicite($id)
{
    $pub = Publicite::findOrFail($id);
    if ($pub->image) {
        Storage::disk('public')->delete($pub->image);
    }
    $pub->delete();

    return redirect()->back()->with('success', 'Publicité supprimée.');
}

//profil
public function profile()
{
    $user = auth()->user(); // ou User::find(...)
    return view('admin.profile.index', compact('user'));
}
}
