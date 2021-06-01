<?php

namespace App\Providers;

use App\Services\Pushall;
use Illuminate\Support\ServiceProvider;

class PushAllServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Pushall::class, function () {
            return new Pushall(config('pushall.key'), config('pushall.id'));
        });
    }
}
