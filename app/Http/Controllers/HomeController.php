<?php


namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(6); // 6 articles par page


        return view('home', compact('articles'));
    }
}
