<?php

namespace App\Providers;

use App\Repositories\Eloquent\ClientRepository;
use App\Repositories\Eloquent\MealRepository;
use App\Repositories\Eloquent\OfferRepository;
use App\Repositories\Eloquent\RestaurantRepository;
use App\Services\Client\ClientAuthService;
use App\Services\Restaurant\MealService;
use App\Services\Restaurant\OfferService;
use App\Services\Restaurant\RestaurantAuthServuce;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $repositories = [
            "Meal" => MealRepository::class,
            "Offer" => OfferRepository::class,
            "Restaurant" => RestaurantRepository::class,
            "Client" => ClientRepository::class
        ];

        foreach ($repositories as $model => $repository) {
            $this->app->bind(
                "App\\Repositories\\Interfaces\\{$model}RepositoryInterface",
                "App\\Repositories\\Eloquent\\{$repository}"
            );
        }

        $this->app->singleton(RestaurantAuthServuce::class, function ($app) {
            return new RestaurantAuthServuce($app->make(RestaurantRepository::class));
        });

        $this->app->singleton(OfferService::class, function ($app) {
            return new OfferService($app->make(OfferRepository::class));
        });
        $this->app->singleton(MealService::class, function ($app) {
            return new MealService($app->make(MealRepository::class));
        });

        $this->app->singleton(ClientAuthService::class, function ($app) {
            return new ClientAuthService($app->make(ClientRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
