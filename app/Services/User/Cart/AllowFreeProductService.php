<?php


namespace App\Services\User\Cart;


class AllowFreeProductService
{
    public function allowFreeProduct($userPoints , $productPoints){
        return $userPoints >= $productPoints;
    }
}
