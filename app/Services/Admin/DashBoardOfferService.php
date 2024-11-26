<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\OfferRepository;
use App\Services\BaseAuthService;

class DashBoardOfferService extends BaseDashboardService
{
    public function __construct(OfferRepository $repository)
    {
        parent::__construct($repository);
    }
}
