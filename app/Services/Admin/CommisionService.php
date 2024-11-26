<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\CommisionRepository;

class CommisionService  extends BaseDashboardService
{
    public function __construct(CommisionRepository $repository)
    {
        parent::__construct($repository);
    }
}
