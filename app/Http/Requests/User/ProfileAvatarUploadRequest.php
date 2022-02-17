<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ProfileAvatarUploadRequest
 * @package App\Http\Requests\User
 */
class ProfileAvatarUploadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'avatar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
