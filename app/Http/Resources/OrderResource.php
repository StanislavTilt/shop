<?php

namespace App\Http\Resources;

use App\Enums\DeliveryTypesValueEnum;
use App\Enums\PaymentTypeKeysEnum;
use App\Models\DeliveryDepartment;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Services\Helpers\OrderHelperService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total' => $this->total,
            'payment_type' => OrderHelperService::getStatusValue(PaymentTypeKeysEnum::KEYS[$this->payment_type]),
            'delivery_type' => OrderHelperService::getStatusValue(DeliveryTypesValueEnum::KEYS[$this->delivery_type]),
            'delivery_address' => $this->delivery_address,
            'delivery_status' => OrderHelperService::getStatusValue($this->delivery_status),
            'delivery_date' => $this->delivery_date,

            'delivery_department' => $this->whenLoaded('deliveryDepartment', function () {
                return new DeliveryDepartmentResource($this->deliveryDepartment);
            }),

            'products' => $this->orderProduct
        ];
    }
}
