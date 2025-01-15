<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
    // public function hasOrders()
    // {
    //     return $this->orders()->where('status','!=', 3)->exists();
    // }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function assignCategory(array $validated)
    {
        $subCategory = Category::find($validated['sub_category_id']);
        $validated['category_id'] = $subCategory->parent_id;
        return $validated;
    }

    public static function getProductsByCategory($categoryId, $subcategoryId = null, $price = null)
    {
        return self::where('category_id', $categoryId)
            ->when($subcategoryId, function ($query, $subcategoryId) {
                $query->where('sub_category_id', $subcategoryId);
            })
            ->when($price === 'high_to_low', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($price === 'low_to_high', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->get();
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favourites', 'product_id', 'user_id');
    }

    public function isFavorited()
    {
        return $this->favoritedBy()->where('user_id', Auth::id())->exists();
    }

}
