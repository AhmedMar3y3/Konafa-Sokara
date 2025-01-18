<?php

namespace App\Services\User\Cart;

use App\Models\Cart;

class DeleteCartService
{
    public function deleteCart($cartId){
        Cart::find($cartId)->delete();
    }
}