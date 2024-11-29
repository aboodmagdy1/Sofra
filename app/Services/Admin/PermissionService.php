<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\PermissionRepository;
use Spatie\Permission\Models\Permission;

class PermissionService extends BaseDashboardService
{
    public function __construct(PermissionRepository $repository)
    {
        parent::__construct($repository);
    }
}
