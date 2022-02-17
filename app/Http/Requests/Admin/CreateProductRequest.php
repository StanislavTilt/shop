<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
                'required',
                'string'
            ],
            'brand_id' => [
                'required',
                'integer',
                'exists:brands,id'
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
            'categories' => [
                'array'
            ],
            'categories.*' => [
                'integer',
                'exists:categories,id'
            ],
            'price' => [
                'required',
                'numeric'
            ],
            'purchase_price' => [
                'required',
                'numeric'
            ],
            'purchase_price_currency' => [
                'required',
                'string'
            ],
            'region' => [
                'required',
                'string'
            ],
            'weight' => [
                'required',
                'integer',
            ],
            'old_price' => [
                'nullable',
                'numeric'
            ],
            'status' => [
                'required',
                'boolean'
            ],
            'options' => [
                'required',
                'array',
            ],
            'options.*.size' => [
                'required',
                'string',
            ],
            'options.*.color_id' => [
                'required',
                'integer',
                'exists:colors,id'
            ],
            'options.*.quantity' => [
                'required',
                'integer',
            ],
            'description' => [
                'required',
                'string',
            ],
            'vendor_id' => [
                'required',
                'integer',
                'exists:vendors,id'
            ],
            'tags' => [
                'array'
            ],
            'tags.*' => [
                'integer',
                'exists:tags,id'
            ],
            'storefronts' => [
                'required',
                'array'
            ],
            'storefronts.*.id' => [
                'required',
                'integer',
                'exists:storefronts,id',
            ],
            'storefronts.*.value' => [
                'required',
                'boolean',
            ],
            'expired_at' => [
                'required'
            ],
            'season_ids' => [
                'required',
                'array'
            ],
            'season_ids.*' => [
                'required',
                'integer',
                'exists:seasons,id'
            ],
            'features' => [
                'required',
                'array',
            ],
        ];
    }
}
