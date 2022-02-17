<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
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
            'name' => [
                'nullable',
                'string'
            ],
            'video' => [
                'mimes:mp4,mov,ogg,qt',
                'max:20000',
            ],
            'photos' => [
                'array'
            ],
            'photos.*' => [
                'mimes:jpeg,png,jpg,gif,svg'
            ],
            'brand_id' => [
                'nullable',
                'integer',
                'exists:brands,id'
            ],
            'categories' => [
                'nullable',
                'array'
            ],
            'categories.*' => [
                'nullable',
                'integer',
                'exists:categories,id'
            ],
            'purchase_price' => [
                'nullable',
                'numeric'
            ],
            'purchase_price_currency' => [
                'nullable',
                'string'
            ],
            'region' => [
                'nullable',
                'string'
            ],
            'weight' => [
                'nullable',
                'integer',
            ],
            'price' => [
                'nullable',
                'numeric',
            ],
            'old_price' => [
                'nullable',
                'numeric'
            ],
            'status' => [
                'nullable',
                'boolean'
            ],
            'options' => [
                'nullable',
                'array',
            ],
            'options.*.attribute_id' => [
                'nullable',
                'integer',
                'exists:attributes,id'
            ],
            'options.*.option_id' => [
                'nullable',
                'integer',
                'exists:attribute_options,id'
            ],
            'options.*.quantity' => [
                'nullable',
                'integer',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'vendor_id' => [
                'nullable',
                'integer',
                'exists:vendors,id'
            ],
            'tags' => [
                'nullable',
                'array'
            ],
            'tags.*' => [
                'nullable',
                'integer',
                'exists:tags,id'
            ],
            'storefronts' => [
                'nullable',
                'array'
            ],
            'storefronts.*.id' => [
                'nullable',
                'integer',
                'exists:storefronts,id',
            ],
            'storefronts.*.value' => [
                'nullable',
                'boolean',
            ],
            'expired_at' => [
                'nullable'
            ],
            'season_ids' => [
                'nullable',
                'array'
            ],
            'season_ids.*' => [
                'nullable',
                'integer',
                'exists:seasons,id'
            ],
            'features' => [
                'nullable',
                'array',
            ],
        ];
    }
}
