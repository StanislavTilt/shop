<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SearchColorRequest extends FormRequest
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
            'name' => [
                'nullable',
                'string',
            ],
            'sort_key' => [
                'nullable',
                'string',
            ],
            'sort_method' => [
                'nullable',
                'string',
                Rule::in(['asc', 'desc'])
            ]
        ];
    }
}
