<?php

namespace App\Repositories\Interfaces;

interface RestaurantRepositoryInterface extends BaseRepositoryInterface
{

    public function filterBy(array $filters);
}
