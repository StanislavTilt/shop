<?php

namespace App\Http\Requests\User;

use App\Models\Order;
use App\ValueObjects\Order\DeliveryType;
use App\ValueObjects\Order\PaymentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/** @mixin Order */
class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_type' => [
                'required',
                'int',
                Rule::in(PaymentType::all())
            ],
            'delivery_type' => [
                'required',
                'int',
                Rule::in(DeliveryType::all())
            ],
            'delivery_address' => [
                'string',
                Rule::requiredIf(function () {
                    return $this->delivery_type === DeliveryType::RUSSIAN_MAIL;
                })
            ],
            'delivery_point_id' => [
                'string',
                Rule::requiredIf(function () {
                    return $this->delivery_type === DeliveryType::CDEK;
                })
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
