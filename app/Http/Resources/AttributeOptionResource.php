<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Models\AttributeOption;

/** @mixin AttributeOption */
class AttributeOptionResource extends JsonResource
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
            'value' => $this->value,
            'quantity' => $this->whenLoaded('optionable', function () {
                return $this->optionable->quantity;
            }),
        ];
    }
}
