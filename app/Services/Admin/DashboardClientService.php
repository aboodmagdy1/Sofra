<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\ClientRepository;

class DashboardClientService extends BaseDashboardService
{
    public function __construct(ClientRepository $repository)
    {
        parent::__construct($repository);
    }
}
