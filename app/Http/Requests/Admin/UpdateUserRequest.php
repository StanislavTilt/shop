<?php

namespace App\Http\Requests\Admin;

use App\Enums\DiscountGroupsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
                'string',
            ],
            'nickname' => [
                'string',
                'unique:users,nickname'
            ],
            'phone' => [
                'string',
                'unique:users,phone',
            ],
            'email' => [
                'string',
                'email',
                'unique:users,email',
            ],
            'mute' => [
                'integer'
            ],
            'ban' => [
                'boolean'
            ],
            'discount' => [
                'integer',
                Rule::in(DiscountGroupsEnum::DISCOUNT_GROUP)
            ]
        ];
    }
}
