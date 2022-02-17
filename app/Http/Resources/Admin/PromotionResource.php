<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image' => isset($this->image) ? url('storage/'.$this->image) : null,
            'percent' => $this->percent,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'is_active' => $this->is_active,
            'promotion_product' => $this->promotionProduct,
        ];
    }
}
