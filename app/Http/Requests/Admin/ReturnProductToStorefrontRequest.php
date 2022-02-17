<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReturnProductToStorefrontRequest extends FormRequest
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
            'storefront_ids' => [
                'required',
                'array'
            ],
            'storefront_ids.*' => [
                'required',
                'integer',
                'exists:storefronts,id'
            ],
            'product_id' => [
                'required',
                'integer',
                'exists:products,id'
            ],
            'expired_at' => [
                'required',
                'date_format:Y-m-d H:i:s'
            ],
        ];
    }
}
