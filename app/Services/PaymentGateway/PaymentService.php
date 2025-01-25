<?php

namespace App\Services\PaymentGateway;

use App\Enums\PaymentTransactions;
use App\Models\PaymentTransaction;
use App\Services\Order\ConfirmOrderService;
use App\Services\Order\ConfirmPaymentOrderService;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;

class PaymentService
{
    /**
     * Factory method to create a payment service instance.
     *
     * @return MyfatoorahService
     *         PaymobService|PaypalService|StripeService|TelrService
     */
    public static function create()
    {
        return new MyFatoorahService;
    }

    public function createPaymentTransaction($amount, $type, $transactionable_type, $transactionable_id, $transaction_id, $payemtResponse, $paymentName, $user = null, $promotion_id = null)
    {

        PaymentTransaction::create([
            'payment_getaway'  => $paymentName,
            'transaction_id'   => $transaction_id,
            'type'             => $type,
            'amount'           => $amount,
            'currency_code'    => 'SAR',
            'status'           => 'pending',
            'getaway_response' => $payemtResponse,
            'trans_type'       => $transactionable_type,
            'trans_id'         => $transactionable_id,
            'user_type'        => $user ? get_class($user) : null,
            'user_id'          => $user ? $user->id : null,
        ]);
    }


    /**
     * This function handles the callback from the payment service.
     * It uses the appropriate service class based on the payment service used.
     *
     * @param Request $request The request object containing paymentId
     * @return mixed The result of the checkPayment function
     */
    public static function callback(Request $request, $brand_id = null)
    {
        $serviceClass = new MyFatoorahService();

        // Get the payment status using the selected service class
        $data = $serviceClass->getPaymentStatus($request->paymentId, $brand_id);
        // Check the payment status and return the result
        return PaymentService::checkPayment($data);
    }

    /**
     * Check the payment status and update the transaction accordingly.
     *
     * @param array $data The payment data.
     */
    public static function checkPayment($data)
    {
        // Retrieve the payment transaction.
        $transaction = PaymentTransaction::with('user', 'trans')->where(
            'transaction_id', $data['transaction_id']
        )->firstOrFail();

        // If payment status is false, return failed view.
        if (!$data['status']) {
            $transaction->update([
                'status' => 'failed'
            ]);
			// Return the success view.
			return redirect()->route('payment.failed', [
				'transaction_id' => $data['transaction_id'],
				'status'         => $data['status']
			]);
        }

        // Update the transaction status.
        $transaction->update([
            'status' => 'completed'
        ]);
        if ($transaction->type == PaymentTransactions::PAY_ORDER->value) {
            (new ConfirmPaymentOrderService())->confirmPayment($transaction->trans);
        }

        // Return the success view.
        return redirect()->route('payment.success', [
			'transaction_id' => $data['transaction_id'],
			'status'         => $data['status']
		]);
    }

	public function success(Request $request)
	{
		return view('payment.success', [
			'trans_id' => $request->transaction_id,
		]);
	}
	public function failed(Request $request)
	{
		return view('payment.failed', [
			'trans_id' => $request->transaction_id,
		]);
	}
}
