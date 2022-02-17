<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Http\Requests\Auth
 *
 * @property string phone
 * @property string password
 * @property string device_name
 */
class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|string',
            'password' => 'required|min:6|max:32',
            'device_name' => 'required|string',
            'device_key' => 'nullable|string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
