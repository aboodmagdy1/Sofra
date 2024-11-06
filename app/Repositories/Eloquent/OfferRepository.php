<?php

namespace App\Repositories\Eloquent;

use App\Models\Offer;
use App\Repositories\Interfaces\OfferRepositoryInterface;

class OfferRepository extends BaseRepository
{

    public function __construct(Offer $model)
    {
        parent::__construct($model);
    }
}
