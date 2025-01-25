<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use App\Services\User\Cart\GetCartSummaryService;

class OrderItemsService
{
    public function createOrderItems($order,$user){
        $items = (new GetCartSummaryService())->getCartItemsSummary($user);

        foreach($items as $item){
            $orderItem = $order->items()->create([
                'product_id'    => $item->product_id,
                'quantity'      => $item->quantity,
                'free_quantity' => $item->free_quantity,
                'product_price' => $item->product->priceAfterDiscount,
                'total_price'   => $item->item_price,
            ]);
            
            foreach($item->additions as $addition){
                $orderItem->additions()->attach($addition->id, [
                    'price' => $addition->price,
                ]);
            }
        }

    }
}