<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'free_quantity',
        'is_free',
        'used_points',
    ];

    protected $casts = [
        'is_free' => 'boolean',
    ];

    public function additions(){
        return $this->belongsToMany(Addition::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute(){
        return (float) ($this->product->priceAfterDiscount * ($this->quantity - $this->free_quantity)) + $this->getAdditionsPrices();
    }

    public function getAdditionsPrices(){
        return $this->additions->sum('price');
    }
}
