<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Models\Attribute;

/** @mixin Attribute */
class AttributeResource extends JsonResource
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
            'type' => $this->type,
            'sort_order' => $this->order,
            'key' => $this->key,
            'options' => $this->whenLoaded('options', function () {
                return AttributeOptionResource::collection($this->options);
            }),
        ];
    }
}
