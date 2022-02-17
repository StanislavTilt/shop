<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PhoneRequest
 * @package App\Http\Requests
 *
 * @property string phone
*/
class PhoneRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|string|exists:users,phone'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
