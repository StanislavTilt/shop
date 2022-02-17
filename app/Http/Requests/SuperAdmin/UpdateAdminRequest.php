<?php

namespace App\Http\Requests\SuperAdmin;

use App\Enums\AdminStatusesEnum;
use App\Enums\UserTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
                'string',
                'unique:users,nickname',
            ],
            'name' => [
                'string',
            ],
            'phone' => [
                'string',
            ],
            'email' => [
                'string',
                'email',
            ],
            'role' => [
                'string',
                Rule::in(UserTypesEnum::ADMIN_ROLES),
            ],
            'status' => [
                'string',
                Rule::in(AdminStatusesEnum::ALL_STATUSES),
            ],
            'avatar' => [
                'mimes:jpeg,jpg,png,gif',
            ]

        ];
    }
}
