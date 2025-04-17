<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $articles = Article::where('category_id', $id)->latest()->paginate(6);

        return view('home', compact('articles', 'category'));
    }
}

