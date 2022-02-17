<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'nullable',
                'string',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'image' => [
                'nullable',
                'mimes:jpeg,png,jpg,gif,svg'
            ],
            'percent' => [
                'nullable',
                'integer',
            ],
            'from_date' => [
                'nullable',
            ],
            'to_date' => [
                'nullable',
            ],
            'is_active' => [
                'nullable',
            ],
            'products_ids' => [
                'nullable',
                'array',
            ],
            'products_ids.*' => [
                'nullable',
                'integer',
                'exists:products,id',
                'unique:promotion_products,id'
            ]
        ];
    }
}
