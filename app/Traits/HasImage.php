<?php

namespace App\Traits;

trait HasImage{
    public function getImageAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value;
    }
}