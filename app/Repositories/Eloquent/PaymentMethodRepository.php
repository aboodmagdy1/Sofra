<?php

namespace App\Repositories\Eloquent;

use App\Models\PaymentMethod;

class PaymentMethodRepository extends BaseRepository
{
    public function __construct(PaymentMethod $model)
    {
        parent::__construct($model);
    }
}
