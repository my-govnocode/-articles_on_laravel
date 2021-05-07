<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TagsSynchronizer;
use App\Models\Tag;
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

        Blade::directive('admin', function($content) {
            $route = route("admin.index");
            if (auth()->check() && auth()->user()->isAdmin()) {
            return '<a class="p-2 text-muted" href="' . $route . '">' . $content . '</a>';
            }
            return abort(404);
        });
    }
}
