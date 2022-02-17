<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;
use Illuminate\Http\Request;

/** @mixin Category */
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
