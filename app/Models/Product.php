<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\ImageUploadHelper;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasImage;

    protected $fillable = [
        'name',
        'image',
        'description',
        'recipe',
        'quantity',
        'price',
        'has_discount',
        'discount_price',
        'avg_rate',
        'can_apply_prize',
        'points',
        'category_id',
        'sub_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function uploadImage($image)
    {
        if ($image) {
            $this->image = ImageUploadHelper::uploadImage($image, 'categories');
        }
    }
}
