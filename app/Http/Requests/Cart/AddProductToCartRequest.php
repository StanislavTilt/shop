<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddProductToCartRequest
 * @package App\Http\Requests\Cart
 */
class AddProductToCartRequest extends FormRequest
{
    /**
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1|required',
            'product_option_id' => 'required|exists:product_options,id',
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
