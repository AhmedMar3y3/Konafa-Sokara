<?php

namespace App\Services\User\Cart;

use App\Http\Resources\Api\User\Cart\CartItemsResource;
use App\Models\Cart;
use App\Models\Setting;

class GetCartSummaryService
{
    public function getCartSummary($user){
        $items = $this->getCartItemsSummary($user);

        return [
            'cart_items'    => CartItemsResource::collection($items),
            'cart_prices'   => $this->getCartPricesSummary($items),
            'currency'      => 'ر.س',
        ];
    }

    public function getCartPricesSummary($items){
        $totalPrice = $items->sum(function ($cartItem) {
            return $cartItem->price;
        });

        $deliveryPrice = Setting::where('key', 'delivery_price')->value('value');

        return [
            'price'            => $totalPrice,
            'delivery_price'   => (float)$deliveryPrice,
            'total_price'      => $totalPrice + $deliveryPrice,
        ];
    }

    public function getCartItemsSummary($user){
        return Cart::with([
                'product:id,name,image,price,has_discount,discount_price',
                'additions:id,price'
            ])
            ->where('user_id', $user->id)
            ->get();
    }
}