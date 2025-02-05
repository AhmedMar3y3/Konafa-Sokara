<?php

namespace App\Http\Resources\Api\User\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MostSoldProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'description' => $this->description,
            'image'     => $this->image,
            'avg_rate'  => $this->avg_rate,
            'price'     => $this->price_after_discount,
            'is_favorited' => $this->isFavorited(),
        ];
    }
}
