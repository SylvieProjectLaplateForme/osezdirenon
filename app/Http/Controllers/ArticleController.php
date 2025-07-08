<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // ✅ Accueil avec liste des articles filtrés
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

    // ✅ Page d’un article
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

    // ✅ Formulaire de création
    public function create()
    {
        $categories = Category::all();
        return view('editeur.articles.create', compact('categories'));
    }

    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
    $imagePath = $request->file('image')->store('articles', 'public');
} else {
    // Image par défaut si aucune image n’est envoyée
    $imagePath = 'articles/default.jpg';
}


        $slug = Str::slug($validated['title']);
        if (Article::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        Article::create([
            'title' => $validated['title'],
            'content' => strip_tags($validated['content'], '<p><br><strong><em><ul><ol><li><a>'),
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
            'is_approved' => false,
            'keywords' => $request->keywords ?? '',
            'image' => $imagePath,
        ]);

        return redirect()->route('editeur.dashboard')->with('success', 'Article envoyé pour validation.');
    }

    // ✅ Formulaire d’édition
    public function edit($id)
    {
        $article = Article::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('is_approved', false)
            ->firstOrFail();

        $categories = Category::all();
        return view('editeur.articles.edit', compact('article', 'categories'));
    }

    // ✅ Mise à jour sans ArticleService
    public function update(Request $request, $id)
    {
        $article = Article::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('is_approved', false)
            ->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
        }

        $article->title = $validated['title'];
        $article->content = $validated['content'];
        $article->category_id = $validated['category_id'];
        $article->save();

        return redirect()->route('editeur.dashboard')->with('success', 'Article modifié avec succès.');
    }
}
