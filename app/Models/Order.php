<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    //TODO : ask about the date in the orders table
    protected $fillable = [
        'user_id',
        'delegate_id',
        'order_num',
        'lat',
        'lng',
        'map_desc',
        'title',
        'price',
        'vat_per',
        'vat_amount',
        'delivery_price',
        'status',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

}
