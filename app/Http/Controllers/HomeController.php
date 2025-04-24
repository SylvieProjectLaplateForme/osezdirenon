<?php


namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Publicite;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $query = Article::with('category');

    if ($request->has('category')) {
        $query->where('category_id', $request->input('category'));
    }

    $articles = $query->latest()->paginate(6);
    $categories = Category::all();
    $publicites = Publicite::where('is_active', true)
        ->where(function($q){
            $q->whereNull('date_debut')->orWhere('date_debut', '<=', now());
        })
        ->where(function($q){
            $q->whereNull('date_fin')->orWhere('date_fin', '>=', now());
        })
        ->latest()
        ->take(5)
        ->get();

    return view('home', compact('articles', 'categories','publicites'));
}
}
