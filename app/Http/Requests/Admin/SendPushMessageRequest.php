<?php

namespace App\Http\Requests\Admin;

use App\Enums\PushMessageTemplateTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SendPushMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $keys = PushMessageTemplateTypesEnum::availableToSendPush();
        return [
            'type_key' => [
                'required',
                'string',
                Rule::in($keys)
            ],
            'object_id' => [
                'nullable',
                'integer',
            ],
            'title' => [
                'required',
                'string',
            ],
            'body' => [
                'required',
                'string'
            ]
        ];
    }
}
