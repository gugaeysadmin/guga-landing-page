<?php

namespace App\Providers;

use App\Models\Alliance;
use App\Models\Offert;
use App\Models\Service;
use App\Models\SpecialityArea;
use App\Observers\AlliancesObserver;
use App\Observers\OffertObserver;
use App\Observers\ServiceObserver;
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
        Offert::observe(classes: OffertObserver::class);
        // Alliance::observe(AlliancesObserver::class);
        // SpecialityArea::observe(SpecialityArea::class);
        // Service::observe(ServiceObserver::class);

    }
}
