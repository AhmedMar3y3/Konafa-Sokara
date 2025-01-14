<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'image' => $this->image,
            'children' => CategoryResource::collection($this->whenLoaded('children'))->map(function ($child) {
                return [
                    'id' => $child->id,
                    'name' => $child->name,
                ];
            }),
        ];
    }
}
