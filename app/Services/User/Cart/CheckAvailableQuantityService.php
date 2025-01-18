<?php

namespace App\Services\User\Cart;

use App\Models\Product;


class CheckAvailableQuantityService
{
    public function checkAvailability(int $productQauntity, int $quantity){
        return $productQauntity >= $quantity;
    }
}