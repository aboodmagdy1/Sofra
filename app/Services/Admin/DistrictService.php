<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\DistrictRepository;


class DistrictService extends BaseDashboardService
{

    public function __construct(DistrictRepository $repository)
    {
        parent::__construct($repository);
    }
}
