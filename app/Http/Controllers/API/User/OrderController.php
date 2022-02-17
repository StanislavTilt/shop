<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\User\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ShortOrdersResource;
use App\Models\Order;
use App\Models\ProductOption;
use App\Services\Helpers\OrderHelperService;
use App\Services\OrderService;
use App\Services\SearchService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class OrderController
 * @package App\Http\Controllers\API\User
 */
class OrderController extends BaseApiController
{
    protected $orderHelper;
    /**
     * OrderController constructor.
     * @param OrderHelperService $orderHelperService
     */
    public function __construct(OrderHelperService $orderHelperService)
    {
        parent::__construct();
        $this->orderHelper = $orderHelperService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $orders = $this->user->orders()->with(['orderProduct.product.tags', 'orderProduct.product.brand', 'orderProduct.productOption.color'])->get()
            ->each(function ($order) {
                $order->summary_price = $this->orderHelper->countSummaryPrice($order);
            });

        return ShortOrdersResource::collection($orders);
    }

    /**
     * @param StoreOrderRequest $request
     * @param OrderService $orderService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOrderRequest $request, OrderService $orderService)
    {
        $validated = $request->validated();

        $res = $orderService->createOrder($this->user, $validated);
        if(is_string($res))
        {
            return $this->getErrorResponse($res);
        }

        return $res;
    }

    /**
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order)
    {
        return new OrderResource($order->load(['orderProduct.product.tags', 'orderProduct.product.brand', 'orderProduct.productOption.color']));
    }

    /**
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @param OrderService $orderService
     */
    public function update(UpdateOrderRequest $request, Order $order, OrderService $orderService)
    {
        $validated = $request->validated();

        $orderService->updateOrder($order, $validated);
    }

    /**
     * @param Order $order
     */
    public function destroy(Order $order)
    {
        $order->delete();
    }
}
