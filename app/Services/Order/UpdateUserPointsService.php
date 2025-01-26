<?php

namespace App\Services\Order;

class UpdateUserPointsService
{
    public function update($user, $points)
    {
        $user->update([
            'points' => $user->points - $points,
        ]);
    }
}