<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PREPARING = 'التجهيز';
    case SHIPPING = 'الشحن';
    case DELIVERED = 'التوصيل';

    public function formattedName(): string
    {
        return ucfirst(strtolower($this->name));
    }
}