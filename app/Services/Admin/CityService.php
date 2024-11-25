<?php

namespace App\Services\Admin;

use App\Models\City;
use App\Repositories\Eloquent\CityRepository;
use Exception;

class CityService extends BaseDashboardService
{
    public function __construct(CityRepository $repository)
    {
        parent::__construct($repository);
    }
}
