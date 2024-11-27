<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\OrderRepository;

class DashboardOrderService extends BaseDashboardService
{
    public function __construct(OrderRepository $repository)
    {
        parent::__construct($repository);
    }
}
