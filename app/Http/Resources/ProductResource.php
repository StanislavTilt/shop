<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\CategoryProductResource;
use App\Http\Resources\Admin\PromotionProductsResource;
use App\Models\CategoryProduct;
use App\Models\ProductSeason;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Models\Product;

/** @mixin Product */
class ProductResource extends JsonResource
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
            'description' => $this->description,
            'old_price' => $this->old_price,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'features' => $this->features,
            'region' => $this->region,
            'removal_time' => $this->removal_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'vendor_id' => $this->vendor_id,
            'weight' => $this->weight,
            'purchase_price' => $this->purchase_price,
            'purchase_price_currency' => $this->purchase_price_currency,
            'seasons' => $this->whenLoaded('productSeasons', function () {
                return ProductSeasonsResource::collection($this->productSeasons);
            }),
            'promotionable' => isset($this->promotionProduct) == 0 ? true : false,
            'promotionProduct' => $this->whenLoaded('promotionProduct', function () {
                return PromotionProductsResource::make($this->promotionProduct);
            }),
            'brand' => $this->whenLoaded('brand', function () {
                return new BrandResource($this->brand);
            }),
            'tags' => $this->whenLoaded('tags', function () {
                return TagResource::collection($this->tags);
            }),
            'categories' => $this->whenLoaded('categories', function () {
                return CategoryProductResource::collection($this->categories);
            }),
//            'options' => $this->whenLoaded('options', function () {
//                return AttributeOptionResource::collection($this->options);
//            }),
            'expired_at' => $this->whenPivotLoaded('storefronts', function () {
                return $this->pivot->expired_at;
            }),
            'images' => $this->getMedia('productImage'),
            'attributes' => $this->whenLoaded('attributes', function () {
                return AttributeResource::collection($this->attributes);
            }),
            'options' => $this->whenLoaded('productOptions', function () {
                return $this->options;
            }),
        ];
    }
}
