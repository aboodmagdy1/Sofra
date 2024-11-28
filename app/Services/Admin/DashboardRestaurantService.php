<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Repositories\Eloquent\RestaurantRepository;

class DashboardRestaurantService extends BaseDashboardService
{

    public function __construct(RestaurantRepository $repository)
    {
        parent::__construct($repository);
    }

    public function filterd(array $filters)
    {
        return  $this->repository->filter($filters);
    }
}
