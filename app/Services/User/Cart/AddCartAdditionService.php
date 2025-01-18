<?php


namespace App\Services\User\Cart;

class AddCartAdditionService
{
    public function addAdditions($cart, $additions){
        if(! empty($additions)){
            $cart->additions()->sync(array_column($additions, 'id'));
        }
    }
}