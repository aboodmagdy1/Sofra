<?php

namespace App\Providers;

use App\Repositories\Eloquent\ClientRepository;
use App\Repositories\Eloquent\MealRepository;
use App\Repositories\Eloquent\OfferRepository;
use App\Repositories\Eloquent\RestaurantRepository;
use App\Services\Client\ClientAuthService;
use App\Services\Client\ClientService;
use App\Services\Restaurant\MealService;
use App\Services\Restaurant\OfferService;
use App\Services\Restaurant\RestaurantAuthServuce;
use App\Services\Restaurant\RestaurantService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
