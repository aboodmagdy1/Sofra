<?php

namespace App\Services\Payments;

interface GetwayInterface
{

    public function purchase(float $amount, string $currency, string $successUrl, string  $cancelUrl);
}
