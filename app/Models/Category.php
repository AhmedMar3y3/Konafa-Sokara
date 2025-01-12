<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasImage;
use App\Helpers\ImageUploadHelper;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasImage;

    protected $fillable = ['name', 'image', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function hasProducts(){
        return $this->products()->exists();
    }
       protected static function boot()
       {
           parent::boot();
   
           static::updating(function ($category) {
               if ($category->isDirty('parent_id') && $category->getOriginal('parent_id')) {
                   $category->parent_id = $category->getOriginal('parent_id');
               }
           });
       }

}
