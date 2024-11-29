<?php

namespace App\Providers;

use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\ClientRepository;
use App\Repositories\Eloquent\CommisionRepository;
use App\Repositories\Eloquent\ContactRepository;
use App\Repositories\Eloquent\DistrictRepository;
use App\Repositories\Eloquent\MealRepository;
use App\Repositories\Eloquent\OfferRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\PaymentMethodRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\RestaurantRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Admin\AdminAuthService;
use App\Services\Admin\CategoryService;
use App\Services\Admin\CityService;
use App\Services\Admin\CommisionService;
use App\Services\Admin\ContactService;
use App\Services\Admin\DashboardClientService;
use App\Services\Admin\DashBoardOfferService;
use App\Services\Admin\DashboardOrderService;
use App\Services\Admin\DashboardRestaurantService;
use App\Services\Admin\PaymentMethodService;
use App\Services\Admin\PermissionService;
use App\Services\Admin\RoleService;
use App\Services\Admin\UserService;
use App\Services\Client\ClientService;
use App\Services\Admin\DistrictService;
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


        // Admin Services
        $this->app->bind(AdminAuthService::class, function ($app) {
            return new AdminAuthService($app->make(UserRepository::class));
        });

        $this->app->bind(CityService::class, function ($app) {
            return new CityService($app->make(CityRepository::class));
        });
        $this->app->bind(DistrictService::class, function ($app) {
            return new DistrictService($app->make(DistrictRepository::class));
        });
        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryService($app->make(CategoryRepository::class));
        });
        $this->app->bind(PaymentMethodService::class, function ($app) {
            return new PaymentMethodService($app->make(PaymentMethodRepository::class));
        });
        $this->app->bind(CommisionService::class, function ($app) {
            return new CommisionService($app->make(CommisionRepository::class));
        });

        $this->app->bind(DashBoardOfferService::class, function ($app) {
            return new DashBoardOfferService($app->make(OfferRepository::class));
        });
        $this->app->bind(ContactService::class, function ($app) {
            return new ContactService($app->make(ContactRepository::class));
        });
        $this->app->bind(DashboardRestaurantService::class, function ($app) {
            return new DashboardRestaurantService($app->make(RestaurantRepository::class));
        });
        $this->app->bind(DashboardClientService::class, function ($app) {
            return new DashboardClientService($app->make(ClientRepository::class));
        });
        $this->app->bind(DashboardOrderService::class, function ($app) {
            return new DashboardOrderService($app->make(OrderRepository::class));
        });
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });
        $this->app->bind(RoleService::class, function ($app) {
            return new RoleService($app->make(RoleRepository::class));
        });
        $this->app->bind(PermissionService::class, function ($app) {
            return new PermissionService($app->make(PermissionRepository::class));
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
