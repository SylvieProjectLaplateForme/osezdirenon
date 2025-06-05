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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\StripeWebhookController;

// route pour notification pub
Route::post('/notifications/clear', function () {
    auth()->user()->notifications->markAsRead();
    return back();
})->middleware(['auth'])->name('notifications.clear');
// =====================
// 🔓 1. Routes publiques (non connectées)
// =====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');

// Route::view('/contact', 'contact')->name('contact');
// Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::post('/articles/{article}/comment', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comment.store');
    
// Route::get('/publicites/creer', [PubliciteController::class, 'create'])
//     ->middleware('auth')
//     ->name('createPub');

Route::view('/apropos', 'apropos')->name('apropos');
Route::view('/cgu', 'cgu')->name('cgu');
Route::view('/confidentialite', 'confidentialite')->name('confidentialite');
Route::get('/plan-du-site', function () {
    $categories = \App\Models\Category::all();
    return view('planSite', compact('categories'));
})->name('plan');

// Redirection vers login si non connecté avec message
Route::get('/publicites/creer', function () {
    if (!auth()->check()) {
        return redirect()->route('login')->with('message', '⚠️ Vous devez être connecté pour proposer une publicité.');
    }
    return app(PubliciteController::class)->create();
})->name('createPub');

// Route::post('/contact', [ContactController::class, 'envoyer'])->name('contact.envoyer');
Route::get('/contact', [ContactController::class, 'afficher'])->name('contact');
Route::post('/contact', [ContactController::class, 'envoyer'])->name('contact.envoyer');
// =====================
// 🔐 2. Authentification Breeze
// =====================
require __DIR__.'/auth.php';

// =====================
// // =====================
// 👩‍💼 3. Routes ADMIN
// =====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard/{filter?}', [AdminController::class, 'dashboard'])->name('dashboard');

    // PROFIL admin
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfilController::class, 'index'])->name('index');
        Route::get('/{id}', [ProfilController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ProfilController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProfilController::class, 'update'])->name('update');
        Route::put('/{id}/toggle', [ProfilController::class, 'toggleActive'])->name('toggle');
    });

    // EDITEURS
    Route::get('/editeurs', [AdminController::class, 'listeEditeurs'])->name('editeurs.index');

    // ARTICLES
    Route::get('/mes-articles', [AdminController::class, 'mesArticles'])->name('articles.mes');
    Route::get('/articles/{id}/edit', [AdminController::class, 'editArticle'])->name('articles.edit');
    Route::put('/articles/{id}', [AdminController::class, 'updateArticle'])->name('articles.update');
    Route::get('/articles', [AdminController::class, 'articlesIndex'])->name('articles.index');
    Route::get('/articles/valides', [AdminController::class, 'articlesValides'])->name('articles.valides');
    Route::get('/articles/en-attente', [AdminController::class, 'articlesEnAttente'])->name('articles.attente');
    Route::get('/articles/create', [AdminController::class, 'createArticle'])->name('articles.create');
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('articles.store');
    Route::get('/articles/{id}', [AdminController::class, 'showArticle'])->name('articles.show');
    Route::put('/articles/{id}/valider', [AdminController::class, 'validerArticle'])->name('articles.validate');
    Route::delete('/articles/{id}', [AdminController::class, 'deleteArticle'])->name('articles.destroy');

    // COMMENTAIRES
    Route::get('/commentaires-en-attente', [AdminController::class, 'commentairesEnAttente'])->name('comments.pending');
    Route::put('/commentaires/{id}/valider', [AdminController::class, 'validateComment'])->name('comments.validate');
    Route::delete('/commentaires/{id}', [AdminController::class, 'deleteComment'])->name('comments.destroy');
    Route::get('/commentaires', [AdminController::class, 'commentairesIndex'])->name('commentaires.index');

    // PUBLICITES
    Route::get('/gestion-publicites', [AdminController::class, 'publicites'])->name('publicites.index');
    Route::get('/publicites/attente', [AdminController::class, 'publicitesEnAttente'])->name('publicites.attente');
    Route::get('/publicites/{id}', [AdminController::class, 'showPublicite'])->name('publicites.show');
    Route::put('/publicites/{id}/valider', [AdminController::class, 'validerPublicite'])->name('publicites.valider');
    Route::delete('/publicites/{id}', [AdminController::class, 'supprimerPublicite'])->name('publicites.destroy');
    Route::put('/publicites/{id}/renouveler', [PubliciteController::class, 'renouveler'])->name('publicites.renouveler');

    // Statistiques Paiements
    Route::get('/admin/statistiques/paiements', [AdminController::class, 'statistiquesPaiements'])->name('paiements.stats');
});

/// =====================
// ✍️ 4. Routes ÉDITEUR
// =====================
Route::middleware(['auth', 'role:editeur'])->prefix('editeur')->name('editeur.')->group(function () {
    Route::get('/dashboard', [EditeurController::class, 'dashboard'])->name('dashboard');

    // ✅ PROFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ ARTICLES
    Route::delete('/articles/{id}', [EditeurController::class, 'destroyArticle'])->name('articles.destroy');
    Route::get('/mes-articles', [EditeurController::class, 'mesArticles'])->name('articles.mes');
    Route::get('/articles', [EditeurController::class, 'mesArticles'])->name('articles.index');
    Route::get('/articles/create', [EditeurController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/en-attente', [EditeurController::class, 'articlesEnAttente'])->name('articles.enAttente');
    Route::get('/articles/{id}', [EditeurController::class, 'showArticle'])->name('articles.show');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
//COMMENTAIRES
    Route::get('/commentaires-en-attente', [EditeurController::class, 'commentairesEnAttente'])->name('commentaires.enAttente');
    Route::get('/commentaires', [EditeurController::class, 'commentairesIndex'])->name('commentaires.index');

    // ✅ PUBLICITÉS
    Route::get('/publicites', [PubliciteController::class, 'mesPublicites'])->name('publicites.index');
    Route::get('/publicites/create', [PubliciteController::class, 'create'])->name('publicites.create');
    Route::post('/publicites', [PubliciteController::class, 'store'])->name('publicites.store');
    Route::get('/publicites/attente', [PubliciteController::class, 'enAttenteEditeur'])->name('publicites.enAttente');
    Route::get('/publicites/payees', [EditeurController::class, 'publicitesPayees'])->name('publicites.payees');
    Route::get('/publicites/a-payer', [PubliciteController::class, 'enAttentePaiement'])->name('publicites.a_payer');

    // ✅ PAIEMENTS
    Route::get('/paiements', [EditeurController::class, 'mesPaiements'])->name('paiements.index');
});


// =====================
// 🌍 5. Publicités ouvertes à tous
// =====================
Route::get('/publicites', [PubliciteController::class, 'afficherPubliques'])->name('publicites.publiques');

// Pour utilisateurs connectés (création)
Route::middleware(['auth'])->group(function () {
    Route::get('/publicites/creer', [PubliciteController::class, 'create'])->name('createPub');
    Route::post('/publicites', [PubliciteController::class, 'store'])->name('publicite.store');
});

// =====================
// 💳 6. Paiement Stripe
// =====================
Route::post('/stripe/payer/{id}', [StripeController::class, 'checkout'])->name('stripe.checkout');
Route::get('/payer-success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/payer-cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle']);


