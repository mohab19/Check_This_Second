<?php

namespace App\Providers;

use App\Services\Companies\AyMakanCompany;
use Illuminate\Support\ServiceProvider;
use App\Services\ShipCompanyStrategy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ShipCompanyStrategy::class, AyMakanCompany::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
