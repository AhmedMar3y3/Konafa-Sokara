<?php

namespace App\Services\OrderPayment;

use App\Enums\PaymentTransactions;
use App\Interface\PayOrderInterface;
use App\Services\PaymentGateway\PaymentService;
use Exception;

class OnlinePaymentService implements PayOrderInterface
{
    public function payOrder($order){
        $paymentService = new PaymentService();
        // Create the payment
        $payment = $paymentService->create()->createPayment([
            'amount' => $order->total_price,
        ], auth()->user());

        if(isset($payment['key']) && $payment['key'] == 'fail') {
            throw new Exception($payment['message']);
        }

        // Create the payment transaction
        $paymentService->createPaymentTransaction(
            $order->total_price,
            PaymentTransactions::PAY_ORDER,
            get_class($order),
            $order->id,
            $payment['transaction_id'],
            $payment['paymentResponse'],
            $payment['payment_name'],
            auth()->user()
        );
        // Check if the request is an API request
        if (request()->is('api/*')) {
            return [
                'redirect_url' => $payment['redirect_url']
            ];
        } else {
            return redirect()->to($payment['redirect_url']);
        }
    }
}