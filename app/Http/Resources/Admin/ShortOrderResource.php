<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ShortOrderResource extends JsonResource
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
            'client_name' => $this->user->name,
            'client_phone' => $this->user->phone,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'summary_price' => $this->summary_price
        ];
    }
}
