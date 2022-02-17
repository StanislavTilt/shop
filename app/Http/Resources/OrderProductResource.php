<?php

namespace App\Http\Resources;

use App\Models\OrderProduct;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin OrderProduct */
class OrderProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price,

            'option' => $this->productOption,

            'product' => $this->whenLoaded('product', function () {
                return new ProductShortResource($this->product);
            })
        ];
    }
}
