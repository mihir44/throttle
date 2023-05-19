<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Imagick;

class ImagickServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('imagick', function ($app) {
            return new Imagick();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
