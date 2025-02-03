<?php

namespace App\Http\Resources\Api\User\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //TODO We need to add date to orders
        return [
            'order_num' => $this->order_num,
            'title' => $this->title,
            'status' => $this->status,
            'total_price' => $this->total_price,
            'items' => OrderItemsResource::collection($this->items),
            'items_count' => $this->items->count(),
        ];   
     }
}
