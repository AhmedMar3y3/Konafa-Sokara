<?php

namespace App\Http\Resources\Api\User\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
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
            'avg_rate' => $this->avg_rate,
            'price' => $this->price,
            'image' => $this->image,
            'recipe' => $this->recipe,
            'can_apply_prize' => $this->can_apply_prize,
            'is_favorited' => $this->isFavorited(),
            'additions' => ProductAdditionResource::collection($this->category->additions ?? [])
        ];
    }
}
