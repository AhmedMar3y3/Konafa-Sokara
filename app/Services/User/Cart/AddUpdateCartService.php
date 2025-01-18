<?php

namespace App\Services\User\Cart;

use App\Models\Cart;
use App\Models\Product;
use App\Services\User\Cart\GetUserAvailablePointsService;
use Illuminate\Support\Facades\DB;

class AddUpdateCartService
{
    public function addToCart(array $validated,$userId,$productId){
        return  Cart::updateOrCreate([
            'user_id'       => $userId,
            'product_id'    => $productId,
        ],$validated);
    }
}
