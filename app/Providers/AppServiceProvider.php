<?php

namespace App\Providers;

use App\Models\Npc;
use App\Models\User;
use App\Observers\NpcObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set('America/Argentina/Buenos_Aires');

        View::share ( 'version', config('app.version'));

        Npc::observe(NpcObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        setlocale(LC_TIME, config('app.locale'));
        Carbon::setLocale('es');
        Paginator::useBootstrap();
    }
}
