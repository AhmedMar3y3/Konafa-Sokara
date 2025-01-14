<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
{

    private $isFavorited;

    public function __construct($resource, $isFavorited = false)
    {
        parent::__construct($resource);
        $this->isFavorited = $isFavorited;
    }
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
            'is_favorited' => $this->isFavorited,
            'additions' => ProductAdditionResource::collection($this->category->additions ?? [])
        ];
    }
}
