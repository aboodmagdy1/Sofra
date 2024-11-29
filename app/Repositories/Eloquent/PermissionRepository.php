<?php

namespace App\Repositories\Eloquent;

use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }
}
