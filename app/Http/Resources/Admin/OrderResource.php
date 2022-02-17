<?php

namespace App\Http\Resources\Admin;

use App\Enums\DeliveryTypesValueEnum;
use App\Enums\OrdersStatusesValueEnum;
use App\Enums\PaymentTypeKeysEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id' => $this->user_id,
            'payment_type' => PaymentTypeKeysEnum::KEYS[$this->payment_type],
            'delivery_type' => DeliveryTypesValueEnum::KEYS[$this->delivery_type],
            'delivery_address' => $this->delivery_address,
            'delivery_status' => $this->delivery_status,
            'status' => OrdersStatusesValueEnum::KEYS[$this->status],
            'payment_time' => $this->payment_time,
            'delivery_date' => $this->delivery_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'delivery_point_id' => $this->delivery_point_id,
            'order_product' => $this->orderProduct,
        ];
    }
}
