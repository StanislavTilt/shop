<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
            ],
            'icon' => [
                'required',
                'mimes:jpg,bmp,png'
            ],
            'cover' => [
                'required',
                'string',
            ],
            'order' => [
                'required',
                'integer'
            ],
            'is_active' => [
                'boolean'
            ],
            'parent_id' => [
                'integer',
                'exists:categories,id'
            ]
        ];
    }
}
