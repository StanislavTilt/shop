<?php

namespace App\Http\Requests\Admin;

use App\Rules\HexColorRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateColorRequest extends FormRequest
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
            'key' => [
                'nullable',
                'string',
            ],
            'hex' => [
                'nullable',
                'string',
                new HexColorRule(),
            ]
        ];
    }
}
