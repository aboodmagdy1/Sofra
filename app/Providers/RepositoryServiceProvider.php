<?php

namespace App\Providers;

use App\Repositories\Eloquent\ClientRepository;
use App\Repositories\Eloquent\MealRepository;
use App\Repositories\Eloquent\OfferRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\RestaurantRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Admin\AdminAuthService;
use App\Services\Client\ClientService;
use App\Services\OrderService;
use App\Services\Restaurant\MealService;
use App\Services\Restaurant\OfferService;
use App\Services\Restaurant\RestaurantService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $models = $this->getModels();
        $models->each(function ($model) {
            $this->app->bind(
                "App\\Repositories\\Interfaces\\{$model}RepositoryInterface",
                "App\\Repositories\\Eloquent\\{$model}Repository"
            );
        });

        // Services binding
        $this->app->bind(RestaurantService::class, function ($app) {
            return new RestaurantService($app->make(RestaurantRepository::class));
        });

        $this->app->bind(OfferService::class, function ($app) {
            return new OfferService($app->make(OfferRepository::class));
        });
        $this->app->bind(MealService::class, function ($app) {
            return new MealService($app->make(MealRepository::class));
        });
        $this->app->bind(ClientService::class, function ($app) {
            return new ClientService($app->make(ClientRepository::class));
        });
        $this->app->bind(OrderService::class, function ($app) {
            return new OrderService($app->make(OrderRepository::class));
        });

        $this->app->bind(AdminAuthService::class, function ($app) {
            return new AdminAuthService($app->make(UserRepository::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function getModels()
    {
        $modelFiles = File::allFiles(app_path('Models'));
        return collect($modelFiles)->map(function ($file) {
            return basename($file->getFilename(), '.php');
        });
    }
}
