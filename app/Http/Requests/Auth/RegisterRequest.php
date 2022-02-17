<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest
 * @package App\Http\Requests\Auth
 *
 * @property string name
 * @property string phone
 * @property string password
 * @property string password_confirmation
 * @property boolean has_subscription
 */
class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|string|min:6|max:32|confirmed:password_confirmation',
            'password_confirmation' => 'required|string|min:6|max:32',
            'has_subscription' => 'nullable|boolean',
            'device_key' => 'nullable|string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
