<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\CategoryProductResource;
use App\Models\CategoryProduct;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Models\Product;

/** @mixin Product */
class ProductShortResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'old_price' => $this->old_price,
            'price' => $this->price,
            'image' => $this->getFirstMediaUrl('productImage'),
            'quantity' => $this->quantity,
            'tags' => $this->whenLoaded('tags', function () {
                return TagResource::collection($this->tags);
            }),
            'brand' => $this->whenLoaded('brand', function () {
                return BrandResource::make($this->brand);
            }),
            'categories' => $this->whenLoaded('categories', function () {
                return CategoryProductResource::collection($this->categories);
            }),

        ];
    }
}
