<?php

namespace App\Repositories\Eloquent;

use App\Models\District;

class DistrictRepository extends BaseRepository
{
    public function __construct(District $model)
    {
        parent::__construct($model);
    }
}
