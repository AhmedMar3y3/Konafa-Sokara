<?php

namespace App\Http\Resources\Api\User\Home;

use App\Services\User\Cart\GetUserAvailablePointsService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrizeProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentPoints = (new GetUserAvailablePointsService())->getUserAvaliablePoints(auth()->user());
        return [
            'id'                => $this->id,
            'image'             => $this->image,
            'needed_points'     => (int)$this->points,
            'current_points'    => $currentPoints,
            'percentage'        => min(100 - round((($this->points - $currentPoints) / $this->points) * 100),100),
            'can_add_product'   => $this->points <= $currentPoints,
        ];
    }
}
