<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\PromotionProductsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Models\Promotion;

/** @mixin Promotion */
class PromotionResource extends JsonResource
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
            'description' => $this->description,
            'image' => isset($this->image) ? url('storage/'.$this->image) : null,
            'percent' => $this->percent,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,

            'products' => $this->whenLoaded('promotionProduct', function () {
                return PromotionProductsResource::collection($this->promotionProduct);
            }),
        ];
    }
}
