<?php

namespace App\Http\Resources;

use App\Enums\OrdersStatusesValueEnum;
use App\Services\Helpers\OrderHelperService;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortOrdersResource extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => OrderHelperService::getStatusValue(OrdersStatusesValueEnum::KEYS[$this->status]),
            'products' => OrderProductResource::collection($this->orderProduct),
            'summary_price' => $this->summary_price,
        ];
    }
}
