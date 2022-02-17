<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePromotionRequest extends FormRequest
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
                'required',
                'string',
            ],
            'description' => [
                'required',
                'string',
            ],
            'image' => [
                'nullable',
                'mimes:jpeg,png,jpg,gif,svg'
            ],
            'percent' => [
                'required',
                'integer',
            ],
            'from_date' => [
                'required',
            ],
            'to_date' => [
                'required',
            ],
            'products_ids' => [
                'required',
                'array',
            ],
            'products_ids.*' => [
                'required',
                'integer',
                'exists:products,id',
                'unique:promotion_products,id'
            ]
        ];
    }
}
