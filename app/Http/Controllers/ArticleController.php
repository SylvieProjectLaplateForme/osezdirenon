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
    public function index(Request $request)
    {
        $query = Article::query()->where('is_approved', true); // seulement approuvés

        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(6);
        $categories = Category::all();

        return view('home', compact('articles', 'categories'));
    }

    // ✅ Voir un article public
    public function show($slug)
    {
        $article = Article::with(['category', 'user', 'comments'])
            ->where('slug', $slug)
            ->firstOrFail();

        $similaires = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(4)
            ->get();

        return view('editeur.articles.show', compact('article', 'similaires'));
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
    
    
}
