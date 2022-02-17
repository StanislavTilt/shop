<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddressUpdateRequest
 * @package App\Http\Requests\User
 */
class AddressUpdateRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'country' => 'required|string',
            'city' => 'required|string',
            'region' => 'required|string',
            'flat' => 'required|string',
            'postal_code' => 'required|string',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
