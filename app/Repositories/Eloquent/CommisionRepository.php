<?php

namespace App\Repositories\Eloquent;

use App\Models\Commision;

class CommisionRepository extends BaseRepository
{
    public function __construct(Commision $model)
    {
        parent::__construct($model);
    }
}
