<?php

namespace App\Services\Order;

use App\Enums\OrderPayStatus;
use App\Enums\OrderPayTypes;
use App\Models\Order;

class ConfirmPaymentOrderService
{
    public function confirmPayment(Order $order)
    {
        if($order->pay_type == OrderPayTypes::ONLINE->value){
            $order->update([
                'pay_status' => OrderPayStatus::PAIED,
            ]);
        }

        $user = $order->user;

        $carts = $user->carts();

        (new UpdateUserPointsService())->update($user, $carts->sum('used_points'));

        $carts->delete();

        
        // any notifications you want here
    }
}   