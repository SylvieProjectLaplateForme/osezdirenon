<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditeurController;

// Auth Breeze
require __DIR__.'/auth.php';

// Pages publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

// Pages statiques
Route::view('/apropos', 'apropos')->name('apropos');
Route::view('/cgu', 'cgu')->name('cgu');
Route::view('/confidentialite', 'confidentialite')->name('confidentialite');

// Dashboard Admin
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard/{filter?}', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//     Route::get('/admin/articles-en-attente', [AdminController::class, 'articlesEnAttente'])->name('admin.articles.pending');
//     Route::get('/admin/articles/{id}', [AdminController::class, 'showArticle'])->name('admin.article.show');

//     Route::put('/admin/articles/{id}/valider', [AdminController::class, 'validerArticle'])->name('admin.article.validate');
//     Route::delete('/admin/articles/{id}', [AdminController::class, 'deleteArticle'])->name('admin.articles.destroy');
// });



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard/{filter?}', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/articles-en-attente', [AdminController::class, 'articlesEnAttente'])->name('admin.articles.pending');
    Route::get('/admin/articles/{id}', [AdminController::class, 'showArticle'])->name('admin.article.show');
    Route::put('/admin/articles/{id}/valider', [AdminController::class, 'validerArticle'])->name('admin.article.validate');
    Route::delete('/admin/articles/{id}', [AdminController::class, 'deleteArticle'])->name('admin.article.destroy');
});


// Dashboard Éditeur
Route::middleware(['auth', 'role:editeur'])->group(function () {
    Route::get('/editeur/dashboard', [EditeurController::class, 'dashboard'])->name('editeur.dashboard');
    Route::get('/editeur/article/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/editeur/article', [ArticleController::class, 'store'])->name('articles.store');
});
