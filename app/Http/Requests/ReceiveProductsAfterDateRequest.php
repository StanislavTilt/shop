<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiveProductsAfterDateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'timestamp' => 'required|date_format:Y-m-d H:i:s'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
