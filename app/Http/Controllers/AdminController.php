<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

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

        return view('dashboard', [
            'articles' => $articles->get(),
            'total' => Article::count(),
            'valides' => Article::where('is_approved', 1)->count(),
            'attente' => Article::where('is_approved', 0)->count(),
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
}
