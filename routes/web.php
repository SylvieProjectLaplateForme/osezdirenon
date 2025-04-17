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
Route::get('/admin/dashboard/{filter?}', [App\Http\Controllers\AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::put('/admin/articles/{id}/validate', [App\Http\Controllers\AdminController::class, 'validateArticle'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.articles.validate');

Route::delete('/admin/articles/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.articles.destroy');



Route::get('/admin/dashboard/{filter?}', [App\Http\Controllers\AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');


// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'role:admin'])->name('admin.dashboard');
Route::put('/admin/articles/{id}/validate', [App\Http\Controllers\AdminController::class, 'validateArticle'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.articles.validate');

    Route::delete('/admin/articles/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.articles.destroy');

    // // ROUTE POUR EDITEUR
    // Route::middleware(['auth', 'role:editeur'])->group(function () {
    //     Route::get('/editeur/article/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('articles.create');
    //     Route::post('/editeur/article', [App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
    // });
    

