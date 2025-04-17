<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;

// 🌟 Authentification Breeze
require __DIR__.'/auth.php';

// 🌍 Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// 📰 Affichage d’un article
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');

// 📬 Page de contact (affichage + traitement)
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// 💬 Commentaire
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

// 🔐 Dashboards sécurisés selon rôle
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin']);

Route::get('/editeur', function () {
    return view('editeur.dashboard');
})->middleware(['auth', 'role:editeur']);

Route::get('/moderateur', function () {
    return view('moderateur.dashboard');
})->middleware(['auth', 'role:moderateur']);
