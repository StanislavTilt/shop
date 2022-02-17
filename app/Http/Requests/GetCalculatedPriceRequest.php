<?php

namespace App\Http\Requests;

use App\Enums\CalculatePriceCurrenciesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GetCalculatedPriceRequest extends FormRequest
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
        return [
            'price' => [
                'required',
                'integer',
            ],
            'currency' => [
                'required',
                'string',
                Rule::in(CalculatePriceCurrenciesEnum::all())
            ],
            'weight' => [
                'required',
            ],
            'country' => [
                'required',
                'string',
            ]
        ];
    }
}
