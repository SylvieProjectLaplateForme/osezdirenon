<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Liste des articles publics (Accueil)
     */
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

    /**
     * Voir un article en public
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('article', compact('article'));
    }

    /**
     * 📌 Espace éditeur : formulaire de création
     */
    public function create()
    {
        $categories = Category::all();

        // 👇 Attention ici c'est important (ERREUR corrigée ici)
        return view('editeur.articles.create', compact('categories'));
    }

    /**
     * 📌 Espace éditeur : enregistrement de l'article
     */
    public function store(Request $request)
    {
        // Validation
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
            'is_approved' => false, // Par défaut en attente
            'image' => $imagePath,
        ]);

        return redirect()->route('editeur.dashboard')->with('success', 'Article envoyé pour validation.');
    }

    /**
     * 📌 Ajouter un commentaire à un article
     */
    public function storeComment(Request $request, Article $article)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string|min:5',
        ]);

        $article->comments()->create($validated);

        return redirect()->route('article.show', $article->slug)
                         ->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * ✅ Supprimer un article (ADMIN uniquement)
     */
    public function delete($id)
    {
        if (!Auth::check() || Auth::user()->role->name !== 'admin') {
            abort(403, 'Accès interdit.');
        }

        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('home')->with('success', 'Article supprimé avec succès.');
    }
}
