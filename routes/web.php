<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditeurController;
use App\Http\Controllers\PubliciteController;
use App\Http\Controllers\StripeController;


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


// 🧑‍💼 Dashboard Éditeur
Route::middleware('auth')->group(function () {
    // ✅ Tableau de bord éditeur
    Route::get('/editeur/dashboard', [EditeurController::class, 'dashboard'])->name('editeur.dashboard');

    // ✅ Route ajoutée : liste des articles de l'éditeur (corrige l'erreur "articles.index not defined")
    Route::get('/editeur/articles', [ArticleController::class, 'index'])->name('articles.index');

    // ✅ Route ajoutée : formulaire création d'article
    Route::get('/editeur/articles/create', [ArticleController::class, 'create'])->name('articles.create');

    // ✅ Route ajoutée : enregistrement de l'article
    Route::post('/editeur/articles', [ArticleController::class, 'store'])->name('articles.store');

    // ✅ Route ajoutée : liste des publicités
    Route::get('/editeur/publicites', [PubliciteController::class, 'mesPublicites'])->name('publicites.index');
    Route::get('/editeur/publicites/create', [PubliciteController::class, 'create'])
    ->middleware('auth')
    ->name('publicites.create');


});

Route::get('/admin/commentaires-en-attente', [AdminController::class, 'commentairesEnAttente'])->name('admin.comments.pending');
Route::put('/admin/commentaires/{id}/valider', [AdminController::class, 'validateComment'])->name('admin.comment.validate');

//route publicité
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/publicites', [PubliciteController::class, 'index'])->name('publicite.index');
    Route::post('/admin/publicites/{id}/toggle', [PubliciteController::class, 'toggle'])->name('publicite.toggle');
    Route::delete('/admin/publicites/{id}', [PubliciteController::class, 'destroy'])->name('publicite.destroy');
});
//route creer pub
// Route::post('/publicites', [PubliciteController::class, 'store'])->name('publicite.store');
// Route::get('/publicites/creer', [PubliciteController::class, 'create'])->name('createPub');
// Publicités condition creer compte
Route::middleware(['auth'])->group(function () {
    Route::get('/publicites/creer', [PubliciteController::class, 'create'])->name('createPub');
    Route::post('/publicites', [PubliciteController::class, 'store'])->name('publicite.store');
});


// Route stripe
// Validation de la pub par l'admin
Route::put('/admin/publicites/{id}/valider', [PubliciteController::class, 'valider'])
     ->name('admin.publicites.valider');

// Stripe paiement pour une pub spécifique
Route::post('/stripe/payer/{id}', [StripeController::class, 'checkout'])->name('stripe.checkout');

// Routes retour Stripe
Route::get('/payer-success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/payer-cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

// Supprimer une pub
Route::delete('/admin/publicites/{id}', [PubliciteController::class, 'destroy'])->name('admin.publicites.supprimer');

// Afficher les publicités en attente pour validation (admin)
Route::get('/admin/publicites', [PubliciteController::class, 'enAttente'])->name('admin.publicites.attente');

// Valider une publicité
Route::put('/admin/publicites/{id}/valider', [PubliciteController::class, 'valider'])->name('admin.publicites.valider');

//route paiement
Route::get('/paiements', [\App\Http\Controllers\EditeurController::class, 'publicitesPayees'])->name('paiements.index');
