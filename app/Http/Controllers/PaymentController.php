<?php

namespace App\Http\Controllers;

use App\Services\Payments\PaypalGetwayService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private PaypalGetwayService $paymentService) {}
    public function  processPayment(Request $request)
    {
        $response =   $this->paymentService->purchase(
            $request->input('amount'),
            $request->input('currency'),
            route('payment.success'),
            route('payment.fail')
        );

        if ($response->isRedirect()) {
            return ['status' => 'success', 'redirect_url' => $response->getData()['links'][1]['href']];
        } else {
            return ['status' => 'fail', 'message' => $response->getMessage()];
        }
    }

    public function success()
    {
        return view('payments.success');
    }
    public function failed()
    {
        return view('payments.fail');
    }
}
