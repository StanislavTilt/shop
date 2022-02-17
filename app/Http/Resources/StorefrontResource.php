<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Models\Storefront;

/** @mixin Storefront */
class StorefrontResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'cover' => url('storage/'.$this->cover),
            'key' => $this->key,
            'parameters' => $this->parameters,
            'products_count' => $this->products_count == null ? 0 : $this->products_count,

            'products' => $this->whenLoaded('products', function () {
                return ProductShortResource::collection($this->products);
            })
        ];
    }
}
