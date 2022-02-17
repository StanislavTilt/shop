<?php

namespace App\Http\Resources\Admin;

use App\Enums\UserStatusesEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUsersListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $ordersCount = count($this->orders);
        $orderSumPrice = 0;
        foreach ($this->orders as $order) {
            foreach ($order->orderProduct as $product)
            {
                $orderSumPrice += $product->price * $product->quantity;
            }
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'avatar' => $this->avatar,
            'phone' => $this->phone,
            'email' => $this->email,
            'has_subscription' => $this->has_subscription,
            'orders_count' => $ordersCount,
            'orders_sum_price' => $orderSumPrice,
            'status' => UserStatusesEnum::STATUSES[$this->status],
            'discount' => $this->discount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
