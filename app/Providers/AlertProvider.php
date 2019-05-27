<?php

namespace App\Providers;

use App\Alert;
use Illuminate\Support\ServiceProvider;

class AlertProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('alerts', function($app) {
            return new Alert();
        });
    }
}
