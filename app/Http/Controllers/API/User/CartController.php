<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Cart\AddProductToCartRequest;
use App\Http\Requests\UpdateCartProductRequest;
use App\Http\Resources\CartResource;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\ProductOption;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

/**
 * Class CartController
 * @package App\Http\Controllers\API\User
 */
class CartController extends BaseApiController
{
    /**
     * @var CartService
     */
    private CartService $cartService;

    /**
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        parent::__construct();
        $this->cartService = $cartService;
    }

    /**
     * @return CartResource
     */
    public function index(): CartResource
    {
        $cart = $this->user->cart()->with([
            'products.product.brand',
            'products.productOption.color'
        ])->firstOrCreate();

        return new CartResource($cart);
    }

    /**
     * @param AddProductToCartRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function addProduct(AddProductToCartRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $product = Product::findOrFail($request->id);
        $productOption = ProductOption::where('product_id',$product->id)
            ->where('id', $request->product_option_id)
            ->firstOrFail();

        $res = $this->cartService->addProductToCart(
            $this->user,
            $product,
            $validated['quantity'],
            $productOption
        );

        if(is_string($res))
        {
            return $this->getErrorResponse($res);
        }

        return $this->getSuccessResponse(200);
    }

    /**
     * @param CartProduct $cartProduct
     * @return JsonResponse
     */
    public function removeCartProduct(CartProduct $cartProduct): JsonResponse
    {
        $this->cartService->removeProductFromCart($cartProduct);

        return $this->getSuccessResponse();
    }

    /**
     * @param UpdateCartProductRequest $request
     * @param CartProduct $cartProduct
     * @return JsonResponse
     */
    public function updateCartProduct(UpdateCartProductRequest $request, CartProduct $cartProduct): JsonResponse
    {
        $validated = $request->validated();

        $this->cartService->updateCartProductQuantity(
            $cartProduct,
            CartService::OPERATION_ASSIGNMENT,
            $validated['quantity'],
        );

        return $this->getSuccessResponse();
    }
}
