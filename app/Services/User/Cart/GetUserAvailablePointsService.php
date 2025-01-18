<?php

namespace App\Services\User\Cart;

use App\Models\Cart;


class GetUserAvailablePointsService
{
    public function getUserAvaliablePoints($user){

        return $user->points - Cart::where('user_id', $user->id)->sum('used_points');
    }
}
