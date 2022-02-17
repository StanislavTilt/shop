<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'nickname' => [
                'string',
                'unique:users,nickname',
            ],
            'avatar' => [
                'mimes:jpg,bmp,png'
            ],
            'phone' => [
                'required',
                'string',
                'unique:users,phone',
            ],
            'email' => [
                'string',
                'unique:users,email',
                'email',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:32',
                'confirmed',
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
