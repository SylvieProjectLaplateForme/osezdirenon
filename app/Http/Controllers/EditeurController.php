<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class EditeurController extends Controller
{
    public function dashboard()
    {
        $articles = Article::with('category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('editeur.dashboard', compact('articles'));
    }
}
