<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ProfileUpdateRequest
 * @package App\Http\Requests\User
 *
 * @property string name
 * @property string nickname
 * @property string avatar
 * @property string email
 * @property boolean has_subscription
 */
class ProfileUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'nickname' => [
                'nullable',
                'string',
                'min:3',
                'max:12',
                Rule::unique('users')->ignore(auth()->id())
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'has_subscription' => 'nullable|boolean',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'region' => 'nullable|string',
            'flat' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
