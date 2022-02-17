<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EndRecoveryRequest extends FormRequest
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
            'phone' => [
                'required',
                'string',
                'exists:users,phone'
            ],
            'code' => [
                'required',
                'string',
                'exists:validation_requests,code'
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:32',
                'confirmed:password_confirmation'
            ],
            'password_confirmation' => [
                'required',
                'string',
                'min:6',
                'max:32',
            ]
        ];
    }
}
