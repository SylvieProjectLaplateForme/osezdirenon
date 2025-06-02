<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    
   

    // ✅ Liste des articles publics (Accueil)
    // public function index(Request $request)
    // {
    //     $query = Article::query()->where('is_approved', true); // seulement approuvés

    //     if ($request->has('search') && !empty($request->search)) {
    //         $query->where('title', 'like', '%' . $request->search . '%');
    //     }

    //     $articles = $query->latest()->paginate(6);
    //     $categories = Category::all();

    //     return view('home', compact('articles', 'categories'));
    // }
    public function index(Request $request)
{
    $query = Article::query()->where('is_approved', true);

    // 🔍 Recherche par mot-clé dans le titre ou contenu
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
        });
    }

    // 🎯 Filtrage par catégorie si sélectionnée
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    $articles = $query->latest()->paginate(6);
    $categories = Category::all();

    return view('home', compact('articles', 'categories'));
}


    // ✅ Voir un article public
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

    // ✅ Formulaire de création (éditeur)
    public function create()
    {
        $categories = Category::all();
        return view('editeur.articles.create', compact('categories'));
    }
    

    // ✅ Soumission article
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // Image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        // Slug unique
        $slug = Str::slug($request->title);
        if (Article::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        // Création
        Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
            'is_approved' => false,
            'image' => $imagePath,
        ]);

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
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('articles', 'public');
        $article->image = $imagePath;
    }

    $article->title = $validated['title'];
    $article->content = $validated['content'];
    $article->category_id = $validated['category_id'];
    $article->save();

    return redirect()->route('editeur.dashboard')->with('success', 'Article modifié avec succès.');
}
    
    
}
