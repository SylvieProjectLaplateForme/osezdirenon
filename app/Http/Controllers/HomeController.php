<?php


namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;


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

    return view('home', compact('articles', 'categories'));
}
}
