<?php

namespace App\Http\Requests\Admin;

use App\Enums\OrderDeliveryStatusesEnum;
use App\ValueObjects\Order\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderChangeStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $statuses = OrderStatus::all();
        $deliveryStatueses = OrderDeliveryStatusesEnum::all();
        return [
            'order_id' => [
                'required',
                'integer',
                'exists:orders,id',
            ],
            'status' => [
                'nullable',
                'integer',
                Rule::in($statuses)
            ],
            'delivery_date' => [
                'nullable',
                'string'
            ],
            'delivery_status' => [
                'nullable',
                'string',
                Rule::in($deliveryStatueses)
            ],
        ];
    }
}
