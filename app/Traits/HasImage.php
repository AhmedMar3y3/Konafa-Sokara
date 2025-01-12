<?php

namespace App\Traits;

use App\Helpers\ImageUploadHelper;

trait HasImage{

    public function setImageAttribute($value)
{
    if ($value) {
        $this->attributes['image'] = ImageUploadHelper::uploadImage($value, 'categories');
    }
}

public function getImageAttribute($value)
{
    return $value ? asset('public/images/' . $value) : null;
}
}