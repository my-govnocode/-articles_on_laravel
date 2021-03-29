<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\FeedbacksController;


Route::get('/', [ArticlesController::class, 'index']);

Route::get('/articles/', [ArticlesController::class, 'index'])->name('articles');
Route::get('/articles/create', [ArticlesController::class, 'create' ])->name('articles.create');
Route::get('/articles/{article:code}', [ArticlesController::class, 'show' ])->name('articles.show');
Route::get('/articles/{article:code}/edit', [ArticlesController::class, 'edit' ])->name('articles.edit');

Route::post('/articles/', [ArticlesController::class, 'store']);
Route::patch('/articles/{article:code}', [ArticlesController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article:code}', [ArticlesController::class, 'destroy'])->name('articles.destroy');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::prefix('/admin')->group(function() {
    Route::get('/feedback', [FeedbacksController::class, 'index'])->name('admin.feedback');
});

Route::get('/contacts', [FeedbacksController::class, 'create'])->name('contacts');


Route::post('/contacts', [FeedbacksController::class, 'store'])->name('contacts');
