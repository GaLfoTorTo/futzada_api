<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Event;
use App\Models\Team;
use App\Observers\UserObserver;
use App\Observers\EventObserver;
use App\Observers\TeamObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(255);
        // REGISTRO DE OBSERVER DE USUARIO
        User::observe(UserObserver::class);
        Event::observe(EventObserver::class);
        Team::observe(TeamObserver::class);
    }
}
