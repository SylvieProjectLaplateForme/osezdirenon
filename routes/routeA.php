<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
// use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeController;

// // Définir la route pour l'accueil
// Route::get('/', [HomeController::class, 'index'])->name('home');

// Page d'accueil avec les articles
// Route::get('/', [HomeController::class, 'index'])->name('home'); // Afficher la page d'accueil avec les articles



// Page individuelle d'un article
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');

// Page Contact
Route::view('/contact', 'contact')->name('contact');

// Traitement du formulaire de contact
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Traitement du formulaire de commentaire
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');



// Route API des news
// Route::get('/api/news', [NewsController::class, 'getFrenchNews']);  // Gardez la route API si nécessaire
