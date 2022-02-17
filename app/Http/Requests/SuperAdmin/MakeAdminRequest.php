<?php

namespace App\Http\Requests\SuperAdmin;

use App\Enums\UserTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MakeAdminRequest extends FormRequest
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
            'nickname' => [
                'required',
                'string',
                'unique:admins,nickname',
            ],
            'name' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'unique:admins,email'
            ],
            'role' => [
                'required',
                'string',
                Rule::in(UserTypesEnum::ADMIN_ROLES),
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
            ],
            'avatar' => [
                'mimes:jpeg,jpg,png,gif',
            ]
        ];
    }
}
