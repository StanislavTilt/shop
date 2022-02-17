<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'icon' => url('storage/'.$this->icon),
            'cover' => $this->cover,
            'order' => $this->order,
            'parent_id' => $this->parent_id,
            'children' => $this->whenLoaded('children', function () {
                return CategoryResource::collection($this->children);
            })
        ];
    }
}
