<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// Rotta per la home page del blog (lista articoli)
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

// Rotte per la gestione degli articoli
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

// Rotta per filtrare gli articoli per tag (che fanno da categoria)
Route::get('/category/{tag}', [ArticleController::class, 'category'])->name('articles.category');

// Rotte di autenticazione
require __DIR__.'/auth.php';