<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\FeedbacksController;


Route::get('/', [ArticlesController::class, 'index']);

Route::get('/articles/', [ArticlesController::class, 'index']);
Route::get('/articles/create', [ArticlesController::class, 'create' ]);
Route::get('/articles/{article:code}', [ArticlesController::class, 'show' ])->name('show');
Route::get('/articles/{article:code}/edit', [ArticlesController::class, 'edit' ]);

Route::post('/articles/', [ArticlesController::class, 'store'])->name('articles');
Route::patch('/articles/{article:code}', [ArticlesController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article:code}', [ArticlesController::class, 'destroy']);

Route::get('/about', function () {
    return view('about');
});

Route::prefix('/admin')->group(function() {
    Route::get('/feedback', [FeedbacksController::class, 'index']);
});

Route::get('/contacts', [FeedbacksController::class, 'create']);


Route::post('/contacts', [FeedbacksController::class, 'store'])->name('contacts');
