<?php

namespace App\Http\Resources;

use App\Models\CartProduct;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin CartProduct */
class CartProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,

            'product' => $this->whenLoaded('product', function () {
                return new ProductResource($this->product);
            }),
            'option' => $this->whenLoaded('productOption', function () {
                return $this->productOption;
            }),

//            'attributes' => $this->whenLoaded('attributes', function () {
//                return AttributeResource::collection($this->attributes);
//            })
        ];
    }
}
