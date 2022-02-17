<?php

namespace App\Http\Resources;

use App\Models\DeliveryDepartment;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin DeliveryDepartment */
class DeliveryDepartmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
