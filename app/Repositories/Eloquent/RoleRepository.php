<?php

namespace App\Repositories\Eloquent;

use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
