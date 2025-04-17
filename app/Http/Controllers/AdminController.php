<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // ✅ On importe le modèle Article

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord admin avec filtre optionnel
     */
    public function dashboard($filter = null)
    {
        // 🎯 On filtre les articles selon l'état
        if ($filter === 'pending') {
            $articles = Article::where('is_approved', false)->latest()->get();
        } elseif ($filter === 'approved') {
            $articles = Article::where('is_approved', true)->latest()->get();
        } else {
            $articles = Article::latest()->get();
        }

        // ✅ On passe bien les données à la vue "dashboard"
        return view('dashboard', [
            'articles' => $articles,
            'filter' => $filter
        ]);
    }

    /**
     * Supprime un article
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Article supprimé avec succès.');
    }

    /**
     * Valide un article
     */
    public function validateArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->is_approved = true;
        $article->save();

        return redirect()->route('admin.dashboard')->with('success', 'Article validé avec succès.');
    }
}
