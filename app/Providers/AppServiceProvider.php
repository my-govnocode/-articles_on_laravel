<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TagsSynchronizer;
use App\Services\CommentsCreator;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TagsSynchronizer::class, function () {
            return new TagsSynchronizer();
        });

        $this->app->bind(CommentsCreator::class, function () {
            return new CommentsCreator();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.bootstrap-4');
        view()->composer('layouts.sidebar', function ($view) {
            $view->with('tagsCloud', Tag::tagsCloud());
        });

        Blade::if('admin', function() {
            return auth()->check() && auth()->user()->isAdmin();
        });
    }
}
