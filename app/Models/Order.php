<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'pay_type',
        'pay_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function delegate()
{
    return $this->belongsTo(Delegate::class);
}

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    private static function generateOrderNum()
    {
        do {
            $orderNum = Str::random(8);
        } while (self::where('order_num', $orderNum)->exists());

        return $orderNum;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->order_num = self::generateOrderNum();
        });
    }
}
