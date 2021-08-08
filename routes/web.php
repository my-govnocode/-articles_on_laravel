<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\AdminSectionController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StatisticController;

Route::get('/', [ArticlesController::class, 'index']);

Route::resource('articles', ArticlesController::class, ['parameters' => [
    'articles' => 'article:code',
]]);

Route::resource('news', NewsController::class, ['parameters' => [
    'news' => 'news:code'
]]);

Route::get('/taggable/{tag}', [TagsController::class, 'index'])->name('taggable');
Route::get('/news/tags/{tag}', [TagsController::class, 'news'])->name('news.tags');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::prefix('/admin')->group(function() {
    Route::get('/', [AdminSectionController::class, 'index'])->name('admin.index');
    Route::get('/articles', [AdminSectionController::class, 'articles'])->name('admin.articles');
    Route::post('/articles/{article:code}/approved/', [AdminSectionController::class, 'approvedArtile'])->name('admin.article.approved');
    Route::post('/news/{news:code}/approved/', [AdminSectionController::class, 'approvedNews'])->name('admin.news.approved');
    Route::get('/news', [AdminSectionController::class, 'news'])->name('admin.news');
});

Route::get('/feedback', [FeedbacksController::class, 'index'])->name('feedback.index');

Route::get('/contacts', [FeedbacksController::class, 'create'])->name('contacts');

Route::post('/contacts', [FeedbacksController::class, 'store'])->name('contacts');

Route::post('/articles/{article:code}', [CommentsController::class, 'article'])->name('comments.article');
Route::post('/news/{news:code}', [CommentsController::class, 'news'])->name('comments.news');

Route::get('/statistic', [StatisticController::class, 'index'])->name('statistic.index');

Auth::routes();
