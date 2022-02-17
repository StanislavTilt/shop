<?php

namespace App\Http\Requests;

use App\ValueObjects\Order\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => [
                'sometimes',
                'integer',
                Rule::in(OrderStatus::all())
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
