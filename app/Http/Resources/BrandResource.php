<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Models\Brand;

/** @mixin Brand */
class BrandResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'is_main' => $this->is_main,
            'products_count' => $this->products_count,

            'products' => $this->whenLoaded('products', function () {
                return ProductShortResource::collection($this->products);
            }),
        ];
    }
}
