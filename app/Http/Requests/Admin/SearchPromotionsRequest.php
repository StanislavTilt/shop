<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SearchPromotionsRequest extends FormRequest
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
            'id' => [
                'nullable',
                'string',
            ],
            'title' => [
                'nullable',
                'string',
            ],
            'from_date' => [
                'nullable',
                'string'
            ],
            'to_date' => [
                'nullable',
                'string'
            ],
            'sort_key' => [
                'nullable',
                'string'
            ],
            'sort_method' => [
                'nullable',
                'string',
            ]
        ];
    }
}
