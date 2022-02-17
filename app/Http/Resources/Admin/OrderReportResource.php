<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderReportResource extends JsonResource
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
            'trouble_text' => $this->trouble_text,
            'action_text' => $this->action_text,
            'text' => $this->text,
            'email' => $this->email,
            'order_id' => $this->order_id,
            'author_id' => $this->author_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'images' => $this->whenLoaded('images', function (){
                return OrderReportImageResource::collection($this->images);
            }),
            'user' => $this->whenLoaded('user', function (){
                return UserResource::make($this->user);
            }),
            'order' => $this->whenLoaded('order', function (){
                return OrderResource::make($this->order);
            }),
        ];
    }
}
