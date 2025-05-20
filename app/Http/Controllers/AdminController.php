<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Models\Publicite;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Paiement;




class AdminController extends Controller
{
    // ✅ Dashboard
    public function dashboard($filter = null)
    {
        $articles = Article::with('user', 'category')->latest();

        if ($filter === 'valide') {
            $articles->where('is_approved', 1);
        } elseif ($filter === 'attente') {
            $articles->where('is_approved', 0);
        }

        $total = Article::count();
        $valides = Article::where('is_approved', true)->count();
        $attente = Article::where('is_approved', false)->count();
        $commentsEnAttente = Comment::where('is_approved', false)->count();
        $totalPublicites = Publicite::count();
        $publicitesEnAttente = Publicite::where('is_approved', false)->count();

        $articlesPerMonth = Article::selectRaw("strftime('%m', created_at) as month, COUNT(*) as count")
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $monthlyCounts = collect(range(1, 12))->map(function ($month) use ($articlesPerMonth) {
            return $articlesPerMonth->get(str_pad($month, 2, '0', STR_PAD_LEFT), 0);
        });

        return view('admin.dashboard', [
            'total' => $total,
            'valides' => $valides,
            'attente' => $attente,
            'commentsEnAttente' => $commentsEnAttente,
            'months' => ['Janv', 'Fév', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
            'articlesPerMonth' => $monthlyCounts,
            'articles' => $articles->take(10)->get(),
            'totalPublicites' => $totalPublicites,
            'publicitesEnAttente' => $publicitesEnAttente,
        ]);
    }
    public function listeEditeurs()
{
    $editeurs = User::with('role')
        ->whereHas('role', function ($query) {
            $query->where('name', 'editeur');
        })
        ->get();

    return view('admin.editeurs.index', compact('editeurs'));
}

    // ✅ Liste articles
    public function articlesIndex()
    {
        $articles = Article::with('user', 'category')->latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function articlesValides()
    {
        $articles = Article::where('is_approved', true)->latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function articlesEnAttente()
    {
        $articles = Article::where('is_approved', false)->latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function showArticle($id)
    {
        $article = Article::with('user', 'category')->findOrFail($id);
        return view('admin.articles.show', compact('article'));
    }

    public function createArticle()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('articles', 'public')
            : null;

        $slug = Str::slug($request->title);
        if (Article::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
            'is_approved' => true,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article publié avec succès.');
    }

    public function validerArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->is_approved = true;
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article validé.');
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé.');
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Commentaire supprimé.');
    }
    public function publicites()
{
    $publicites = Publicite::with('user')->latest()->paginate(15);
    return view('admin.publicites.index', compact('publicites'));
}
public function publicitesEnAttente()
{
    $publicites = Publicite::where('is_approved', false)->latest()->paginate(15);
    return view('admin.publicites.attente', compact('publicites'));
}
// public function validerPublicite($id)
// {
//     $publicite = Publicite::findOrFail($id);

//     $publicite->is_approved = true;

//     // Si aucune date de validité n’existe encore, on la crée :
//     if (!$publicite->valid_until) {
//         $debut = $publicite->date_debut ?? now();
//         $publicite->valid_until = Carbon::parse($debut)->addDays(30);
//     }

//     $publicite->save();

//     return redirect()->back()->with('success', '✅ Publicité validée avec succès jusqu’au ' . $publicite->valid_until->format('d/m/Y'));
// }
public function validerPublicite($id)
{
    $publicite = Publicite::findOrFail($id);
    $publicite->is_approved = true;
    $publicite->save();

    return redirect()->back()->with('success', 'Publicité validée avec succès. Paiement en attente.');
}

public function supprimerPublicite($id)
{
    $publicite = Publicite::findOrFail($id);

    // Supprimer l'image si elle existe
    if ($publicite->image) {
        Storage::disk('public')->delete($publicite->image);
    }

    $publicite->delete();

    return redirect()->route('admin.publicites.index')->with('success', 'Publicité supprimée avec succès.');
}
public function statistiquesPaiements(Request $request)
{
    $query = Paiement::where('status', 'paid');

    // 🎯 Filtres
    if ($request->filled('mois') && $request->filled('annee')) {
        $query->whereMonth('paid_at', $request->mois)
              ->whereYear('paid_at', $request->annee);
    }

    $paiements = $query->latest()->get();
    $total = $paiements->sum('amount');

    return view('admin.stats.paiements', compact('paiements', 'total'));
}



}
