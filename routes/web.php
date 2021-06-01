<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\AdminSectionController;
use App\Http\Controllers\PushAllServiceController;
use App\Http\Controllers\TagsController;
use App\Providers\PushAllServiceProvider;
use App\Services\Pushall;

Route::get('/', [ArticlesController::class, 'index']);

Route::resource('articles', ArticlesController::class, ['parameters' => [
    'articles' => 'article:code'
]]);

Route::get('/articles/tags/{tag}', [TagsController::class, 'index'])->name('articles.tags');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::prefix('/admin')->group(function() {
    Route::get('/', [AdminSectionController::class, 'index'])->name('admin.index');
    Route::post('/{article:code}/approved/', [AdminSectionController::class, 'approved'])->name('admin.approved');
});

Route::get('/feedback', [FeedbacksController::class, 'index'])->name('feedback.index');

Route::get('/contacts', [FeedbacksController::class, 'create'])->name('contacts');

Route::post('/contacts', [FeedbacksController::class, 'store'])->name('contacts');

Auth::routes();
