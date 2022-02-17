<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductShortResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'promotion_id' => $this->promotion_id,
            'product_id' => $this->product_id,
            'product' => $this->whenLoaded('product', function () {
                return ProductShortResource::make($this->product);
            }),
            'promotion' => $this->whenLoaded('promotion', function () {
                return PromotionResource::make($this->promotion);
            }),
        ];
    }
}
