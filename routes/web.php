<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;

// Routes auth Breeze
require __DIR__.'/auth.php';
// Page de contact
Route::view('/contact', 'contact')->name('contact');


Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// 🟢 Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🟢 Affichage d’un article
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');

// 🔐 Admin uniquement
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin']);

// 🔐 Éditeur uniquement
Route::get('/editeur', function () {
    return view('editeur.dashboard');
})->middleware(['auth', 'role:editeur']);

// 🔐 Modérateur uniquement
Route::get('/moderateur', function () {
    return view('moderateur.dashboard');
})->middleware(['auth', 'role:moderateur']);