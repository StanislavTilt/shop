<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @see \App\Models\Cart */
class CartResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array[]
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            
            'products' => $this->whenLoaded('products', function () {
                return CartProductResource::collection($this->products);
            }),

        ];
    }
}
