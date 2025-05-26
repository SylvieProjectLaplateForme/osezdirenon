<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Publicite;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Paiement;


class EditeurController extends Controller
{
    // Dashboard
    public function dashboard()
{
    $userId = auth()->id();

    // Articles récents
    $articles = Article::where('user_id', $userId)->latest()->take(5)->get();

    // ✅ Statistiques
    $totalArticles = Article::where('user_id', $userId)->count();
    $attenteArticles = Article::where('user_id', $userId)->where('is_approved', false)->count();
    $totalPublicites = Publicite::where('user_id', $userId)->count();
    $publicites = Publicite::where('user_id', $userId)->where('is_approved', false)->get();

    $pubsAPayer = Publicite::where('user_id', $userId)
        ->where('is_approved', true)
        ->where('paid', false)
        ->count();

    $totalPaiements = Paiement::where('user_id', $userId)->count();

    return view('editeur.dashboard', compact(
        'articles',
        'totalArticles',
        'attenteArticles',
        'totalPublicites',
        'publicites',
        'pubsAPayer',
        'totalPaiements'
    ));
}

// public function mesArticles()
// {
//     $articles = Article::where('user_id', auth()->id())->latest()->paginate(10); // ✅

//     return view('editeur.articles.index', compact('articles'));
// }
public function mesArticles()
{
    $articles = Article::where('user_id', auth()->id())
        ->with('category')
        ->latest()
        ->get();

    return view('editeur.articles.mesArticles', compact('articles'));
}



    // Articles en attente
    public function articlesEnAttente()
    {
        $articlesEnAttente = Article::where('user_id', auth()->id())
            ->where('is_approved', false)
            ->latest()
            ->get();

        return view('editeur.articles.enAttente', compact('articlesEnAttente'));
    }
    
public function showArticle($id)
{
    $article = Article::findOrFail($id);

    // Chargement d'articles similaires (même catégorie, autres articles)
    $similaires = Article::where('category_id', $article->category_id)
                    ->where('id', '!=', $article->id)
                    ->take(3)
                    ->latest()
                    ->get();

    return view('editeur.articles.show', compact('article', 'similaires'));
}



    // Créer un article
    public function create()
    {
        $categories = Category::all();
        return view('editeur.articleCreate', compact('categories'));
    }
    // ✅ Supprimer un article si non validé
public function destroyArticle($id)
{
    $article = Article::where('id', $id)
        ->where('user_id', auth()->id())
        ->where('is_approved', false)
        ->firstOrFail();

    $article->delete();
     $title = $article->title;


    return redirect()->route('editeur.articles.mes')->with('success', "L’article \"$title\" a été supprimé avec succès.");
}


    // ✅ Affiche le formulaire de création d’une publicité
    public function createPub()
{
    return view('editeur.publicites.pubCreate'); //  bien placé
}


   public function publicitesPayees()
{
    $publicites = Publicite::with('paiement') 
        ->where('user_id', auth()->id())
        ->where('paid', true)
        ->latest()
        ->get();
        // Calcul du total payé
    $totalMontant = $publicites->sum(fn($pub) => $pub->paiement->amount ?? 0);

    return view('editeur.publicites.payees', compact('publicites', 'totalMontant'));

    
}
//paiement stripe
// public function paiements()
// {
//     $paiements = paiement::where('user_id', auth()->id())->latest()->get();

//     return view('editeur.paiements', compact('paiements'));
// }

public function mesPaiements()
{
    $paiements = Paiement::where('user_id', auth()->id())->latest()->get();
     $totalPaiements = $paiements->sum('amount');
    return view('editeur.paiements.index', compact('paiements','totalPaiements'));
}


}
