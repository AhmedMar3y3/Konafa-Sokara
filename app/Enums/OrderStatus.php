<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PREPARING = 0;
    case SHIPPING = 1;
    case DELIVERED = 2;

    public function formattedName(): string
    {
        return ucfirst(strtolower($this->name));
    }
}