<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Publicite;
use App\Models\Category;
use App\Models\Paiement;

class EditeurController extends Controller
{
    // 🎯 Tableau de bord
//     public function dashboard()
// {
//     $userId = Auth::id();

//     $articles = Article::with('category')
//         ->where('user_id', $userId)
//         ->latest()
//         ->get();

//     $publicites = Publicite::where('user_id', $userId)
//         ->latest()
//         ->get();

//     $pubsPayees = Publicite::where('user_id', $userId)
//         ->where('paid', true)
//         ->get();

//     $categories = Category::all();

//     return view('editeur.dashboard', compact('articles', 'categories', 'publicites', 'pubsPayees'));
// }

public function dashboard()
{
    $userId = auth()->id();

    $articlesValides = Article::where('user_id', $userId)->where('is_approved', true)->get();
    $articlesEnAttente = Article::where('user_id', $userId)->where('is_approved', false)->get();

    $pubsValidees = Publicite::where('user_id', $userId)->where('approved', 1)->get();
    $pubsAttente = Publicite::where('user_id', $userId)->where('approved', 0)->get();
    $pubsPayees = Publicite::where('user_id', $userId)->where('paid', 1)->get();

    return view('editeur.dashboard', compact(
        'articlesValides', 'articlesEnAttente',
        'pubsValidees', 'pubsAttente', 'pubsPayees'
    ));
}

    // ✅ Publicités payées (Stripe)
    public function publicitesPayees()
    {
        $userId = Auth::id();

        $publicitesPayees = Publicite::where('user_id', $userId)
            ->where('paid', true)
            ->get();

        return view('editeur.publicites-payees', [
            'publicites' => $publicitesPayees,
            'articles' => [], // Optionnel : tu peux charger les articles ici si besoin
            'categories' => Category::all(),
        ]);
    }
}
