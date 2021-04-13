<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TagsSynchronizer;
use App\Models\Tag;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view) {
            $view->with('tagsCloud', Tag::tagsCloud());
        });
    }
}
