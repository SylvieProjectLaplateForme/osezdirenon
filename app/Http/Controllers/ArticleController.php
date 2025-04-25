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
     * Affiche le formulaire de création d'article
     */
    public function create()
    {
        $categories = Category::all();
        return view('editeur.create', compact('categories'));
    }
    

    /**
     * Enregistre un nouvel article envoyé par un éditeur
     */
    public function store(Request $request)
    {
        // ✅ Validation des champs y compris image
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',

        ]);

        // ✅ Gestion du fichier image s’il est présent
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }
        $slug = Str::slug($request->title);
    
    // Vérifie si ce slug existe déjà
    $slugExists = Article::where('slug', $slug)->exists();

    // Si oui, ajoute une fin unique
    if ($slugExists) {
        $slug .= '-' . uniqid();
    }

        // ✅ Création de l'article
        Article::create([
            'title' => $validated['title'],
    'content' => $validated['content'],
    'slug' => $slug, // ✅ ici le slug est bien envoyé
    'category_id' => $validated['category_id'],
    'user_id' => Auth::id(),
    'is_approved' => false,
    'image' => $imagePath,

        ]);

        return redirect()->route('editeur.dashboard')->with('success', 'Article envoyé pour validation.');
    }

    /**
     * Liste des articles avec recherche
     */
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(6); // ou 10, selon ce que tu veux

        $categories = Category::all(); // ✅ ligne ajoutée

        return view('home', compact('articles','categories' ));
    }

    /**
     * Affiche un article en détail
     */
    public function show($slug)
{
    $article = Article::where('slug', $slug)->firstOrFail();
    return view('article', compact('article'));
}

    /**
     * Ajoute un commentaire à un article
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
     * Supprime un article (réservé à l'admin)
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
