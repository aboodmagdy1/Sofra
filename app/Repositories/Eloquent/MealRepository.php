<?php

namespace App\Repositories\Eloquent;

use App\Models\Meal;

class MealRepository extends BaseRepository
{
    public function __construct(Meal $model)
    {
        parent::__construct($model);
    }
}
