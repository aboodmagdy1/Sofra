<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\PaymentMethodRepository;

class PaymentMethodService  extends BaseDashboardService
{
    public function __construct(PaymentMethodRepository $repository)
    {
        parent::__construct($repository);
    }
}
