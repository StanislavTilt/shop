<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class VerifyPhoneRequest
 * @package App\Http\Requests
 *
 * @property string phone
 * @property int code
 * @property string device_name
 */
class VerifyPhoneRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|string|exists:users,phone',
            'code' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
