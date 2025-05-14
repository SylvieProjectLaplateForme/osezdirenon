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

    // Statistiques
    $totalArticles = Article::where('user_id', $userId)->count();
    $attenteArticles = Article::where('user_id', $userId)->where('is_approved', false)->count();
    $totalPublicites = Publicite::where('user_id', $userId)->count();
    $publicites = Publicite::where('user_id', $userId)->where('is_approved', false)->get();
    return view('editeur.dashboard', compact(
        'articles',
        'totalArticles',
        'attenteArticles',
        'totalPublicites',
        'publicites'
    ));
}

public function mesArticles()
{
    $articles = Article::where('user_id', auth()->id())->latest()->paginate(10); // ✅

    return view('editeur.articles.index', compact('articles'));
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
    //pour voir article en attente de validation
    public function showArticle($id)
{
    $article = Article::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    return view('editeur.articles.show', compact('article'));
}


    // Créer un article
    public function create()
    {
        $categories = Category::all();
        return view('editeur.articleCreate', compact('categories'));
    }
    
    // ✅ Affiche le formulaire de création d’une publicité
    public function createPub()
{
    return view('editeur.publicites.pubCreate'); //  bien placé
}


    public function publicitesPayees()
{
    $userId = Auth::id();

    $publicites = Publicite::where('user_id', $userId)
        ->where('paid', true)
        ->get();

    return view('editeur.publicitesPayees', compact('publicites'));
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
    return view('editeur.paiements.index', compact('paiements'));
}

}
