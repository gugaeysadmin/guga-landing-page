<?php

namespace App\Providers;

use App\Models\Offert;
use App\Observers\OffertObserver;
use Illuminate\Support\ServiceProvider;

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
        Offert::observe(OffertObserver::class);

    }
}
