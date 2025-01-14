<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountedProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'avg_rate' => $this->avg_rate,
            'description' => $this->description,
            'image' => $this->image,
            'discount' => round((($this->price - $this->discount_price) / $this->price) * 100),
        ];
    }
}
