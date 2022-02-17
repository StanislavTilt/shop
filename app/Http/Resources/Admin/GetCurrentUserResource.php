<?php

namespace App\Http\Resources\Admin;

use App\Enums\UserStatusesEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class GetCurrentUserResource extends JsonResource
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
            'name' => $this->name,
            'nickname' => $this->nickname,
            'phone' => $this->phone,
            'email' => $this->email,
            'status' => UserStatusesEnum::STATUSES[$this->status],
            'avatar' => $this->avatar ? asset($this->avatar) : null,
            'discount' => $this->discount,
            'orders_count' => $this->orders_count,
            'orders_sum_price' => $this->orders_sum_price,
            'has_subscription' => $this->has_subscription,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'orders' => OrderResource::collection($this->orders)
        ];
    }
}
