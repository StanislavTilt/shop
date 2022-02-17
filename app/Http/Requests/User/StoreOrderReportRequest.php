<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderReportRequest extends FormRequest
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
        return [
            'trouble_text' => [
                'required',
                'string',
            ],
            'action_text' => [
                'required',
                'string',
            ],
            'images' => [
                'nullable',
                'array'
            ],
            'images.*' => [
                'nullable',
                'mimes:jpg,bmp,png'
            ],
            'text' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'email',
                'string',
            ],
            'order_id' => [
                'required',
                'integer',
                'exists:orders,id',
            ]
        ];
    }
}
