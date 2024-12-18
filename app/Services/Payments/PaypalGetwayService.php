<?php

namespace App\Services\Payments;

use Exception;
use Omnipay\Omnipay;

class PaypalGetwayService implements GetwayInterface
{
    protected $getway;

    public function __construct()
    {
        $this->getway =  Omnipay::create('PayPal_Rest');
        // dd($this->getway->getDefaultParameters());
        $this->getway->initialize([
            'clientId' => env('PAYPAL_SANDBOX_CLIENT_ID'),
            'secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
            'testMode' => true,
        ]);
    }

    public function purchase($amount, $currency, $successUrl, $cancelUrl)
    {
        try {
            $response =   $this->getway->purchase([
                'amount' => $amount,
                'currency' => $currency,
                'returnUrl' => $successUrl,
                'cancelUrl' => $cancelUrl,
            ])->send();

            return $response;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
