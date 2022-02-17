<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GetAvailableFiltersRequest
 * @package App\Http\Requests
 */
class GetAvailableFiltersRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'category_id' => 'nullable|int|exists:categories,id',
            'brand_id' => 'nullable|int|exists:brands,id',
            'name' => 'nullable|string'
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
