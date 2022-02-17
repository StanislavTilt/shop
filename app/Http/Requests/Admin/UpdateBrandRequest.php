<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBrandRequest extends FormRequest
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
            'logo' => [
                'nullable',
                'string',
            ],
            'is_active' => [
                'nullable',
                'boolean'
            ],
            'is_main' => [
                'nullable',
                'boolean'
            ],
        ];
    }
}
