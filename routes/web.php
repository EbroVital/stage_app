<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliberationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferenceJuridiqueController;
use App\Http\Controllers\SignataireController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestion des avis
    Route::prefix('avis')->group(function() {
        Route::get('/', [AvisController::class, 'index'])->name('avis.index');
        Route::get('/create', [AvisController::class, 'create'])->name('avis.create');
        Route::post('/', [AvisController::class, 'store'])->name('avis.store');
        Route::get('{avis}/edit', [AvisController::class, 'edit'])->name('avis.edit');
        Route::put('update/{avis}', [AvisController::class, 'update'])->name('avis.update');
        Route::delete('delete/{avis}', [AvisController::class, 'destroy'])->name('avis.destroy');
    });

    // Gestion des deliberations
    Route::prefix('deliberation')->group( function(){
        Route::get('/', [DeliberationController::class, 'index'])->name('deliberation.index');
        Route::get('/create', [DeliberationController::class, 'create'])->name('deliberation.create');
        Route::post('/', [DeliberationController::class, 'store'])->name('deliberation.store');
        Route::get('{deliberation}/edit', [DeliberationController::class, 'edit'])->name('deliberation.edit');
        Route::put('update/{deliberation}', [DeliberationController::class, 'update'])->name('deliberation.update');
        Route::delete('delete/{deliberation}', [DeliberationController::class, 'destroy'])->name('deliberation.destroy');
    });

    // Gestion des articles

    // Tous les articles liés aux avis
    Route::get('/articles/avis', [ArticleController::class, 'listeArticlesAvis'])->name('articles.avis.liste');

    // Tous les articles liés aux délibérations
    Route::get('/articles/deliberations', [ArticleController::class, 'listeArticlesDeliberation'])->name('articles.deliberations.liste');

    Route::prefix('article')->group( function(){
        Route::get('/', [ArticleController::class, 'index'])->name('article.index');
        Route::get('/create/{type}/{id}', [ArticleController::class, 'create'])->name('article.create');
        Route::post('/', [ArticleController::class, 'store'])->name('article.store');
        Route::get('/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
        Route::put('update/{id}', [ArticleController::class, 'update'])->name('article.update');
        Route::delete('delete/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
    });

    Route::prefix('Elu')->group( function(){
        Route::get('/', [SignataireController::class, 'index'])->name('signataires.index');
        Route::get('/create', [SignataireController::class, 'create'])->name('signataires.create');
        Route::post('/', [SignataireController::class, 'store'])->name('signataires.store');
        Route::get('/{id}/edit', [SignataireController::class, 'edit'])->name('signataires.edit');
        Route::put('/{id}', [SignataireController::class, 'update'])->name('signataires.update');
        Route::delete('/{id}', [SignataireController::class, 'destroy'])->name('signataires.destroy');
    });

    // Gestion des lois/decrets/arrêtés
    Route::resource('references', ReferenceJuridiqueController::class);
    // Routes spécifiques pour les associations
    Route::post('/references/{id}/attach-avis', [ReferenceJuridiqueController::class, 'attachToAvis'])->name('references.attach.avis');
    Route::post('/references/{id}/attach-deliberation', [ReferenceJuridiqueController::class, 'attachToDeliberation'])->name('references.attach.deliberation');

    // generer les pdf
    Route::get('/pdf/selection', [PdfController::class, 'index'])->name('pdf.index');
    Route::get('/pdf/get-documents', [PdfController::class, 'getDocuments'])->name('pdf.getDocuments');
    Route::get('/pdf/download/{type}/{id}', [PdfController::class, 'download'])->name('pdf.download');


});

require __DIR__.'/auth.php';
