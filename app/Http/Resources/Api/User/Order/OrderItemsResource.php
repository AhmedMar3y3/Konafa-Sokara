<?php

namespace App\Http\Resources\Api\User\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_name'      => $this->product->name,
            'product_image'     => $this->product->image,
            'item_additions'    => OrderItemAdditionResource::collection($this->additions),
            'price'             => $this->total_price + $this->additions->sum('price') . ' ' . __('admin.rs'),
        ];
    }
}
