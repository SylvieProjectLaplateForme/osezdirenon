<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query()->where('is_approved', true);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $articles = $query->latest()->paginate(6);
        $categories = Category::all();

        return view('home', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::with(['category', 'user', 'comments.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        $similaires = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(4)
            ->get();

        return view('article', compact('article', 'similaires'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('editeur.articles.create', compact('categories'));
    }

    public function store(Request $request, ArticleService $service)
    {
        $service->createArticle($request);
        return redirect()->route('editeur.dashboard')->with('success', 'Article envoyé pour validation.');
    }

    public function edit($id)
    {
        $article = Article::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('is_approved', false)
            ->firstOrFail();

        $categories = Category::all();
        return view('editeur.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id, ArticleService $service)
    {
        $article = Article::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('is_approved', false)
            ->firstOrFail();

        $service->updateArticle($request, $article);
        return redirect()->route('editeur.dashboard')->with('success', 'Article modifié avec succès.');
    }
}
