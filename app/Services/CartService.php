<?php


namespace App\Services;


use App\Models\CartProduct;
use App\Models\Pivot\Optionable;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Support\Collection;

class CartService
{
    const OPERATION_ASSIGNMENT = 0;
    const OPERATION_DECREMENT = 1;
    const OPERATION_INCREMENT = 2;

    /**
     * @param User $user
     * @param Product $product
     * @param int $quantity
     * @param ProductOption $productOption
     * @return void
     */
    public function addProductToCart(
        User $user,
        Product $product,
        int $quantity,
        ProductOption $productOption
    )
    {
        $cartProduct = $this->getCartProduct($user, $product, $productOption);

        if($productOption->quantity < $quantity)
        {
            return __('order_errors.not_enough_stock');
        }

        if (!is_null($cartProduct)) {
            $this->updateCartProductQuantity($cartProduct, self::OPERATION_INCREMENT, $quantity);
        } else {
            $user->cart->products()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'product_option_id' => $productOption->id
            ]);
        }
    }

    /**
     * @param CartProduct $cartProduct
     * @param int $operation
     * @param int $quantity
     * @return bool|null
     */
    public function updateCartProductQuantity(CartProduct $cartProduct, int $operation, int $quantity = 1): ?bool
    {
        $cartProductQuantity = $cartProduct->quantity;

        switch ($operation) {
            case self::OPERATION_DECREMENT:
                $cartProductQuantity -= $quantity;
                break;
            case self::OPERATION_INCREMENT:
                $cartProductQuantity += $quantity;
                break;
            case self::OPERATION_ASSIGNMENT:
                $cartProductQuantity = $quantity;
                break;
        }

        if ($quantity === 0) {
            return $this->removeProductFromCart($cartProduct);
        }

        return $this->updateCartProduct($cartProduct, [
            'quantity' => $cartProductQuantity
        ]);
    }


    /**
     * @param CartProduct $cartProduct
     * @param array $payload
     * @return bool
     */
    public function updateCartProduct(CartProduct $cartProduct, array $payload): bool
    {
        return $cartProduct->update($payload);
    }

    /**
     * @param CartProduct $cartProduct
     * @return bool|null
     */
    public function removeProductFromCart(CartProduct $cartProduct): ?bool
    {
        $cartProduct->options()->detach();
        return $cartProduct->delete();
    }

    /**
     * @param User $user
     * @param Product $product
     * @param ProductOption $productOptionId
     * @return CartProduct|null
     */
    private function getCartProduct(
        User $user,
        Product $product,
        ProductOption $productOptionId
    ): ?CartProduct
    {
        return $user
            ->cart
            ->products
            ->where('product_id', $product->id)
            ->where('product_option_id', $productOptionId->id)
            ->first();
    }
}
