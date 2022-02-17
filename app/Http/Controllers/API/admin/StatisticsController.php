<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class StatisticsController
 * @package App\Http\Controllers\Api\admin
 */
class StatisticsController extends BaseApiController
{
    /**
     * StatisticsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    public function __invoke()
    {
        $purchasedProducts = array_sum(OrderProduct::all()->pluck('quantity')->toArray());
        $ordersSum = array_sum(OrderProduct::all()->pluck('price')->toArray());

        $orderCount = Order::all()->count();
        $validatedOrdersCount = $orderCount  == 0 ? 1 : $orderCount;

        return [
            //TODO anonim users
            'products' => Product::count(),
            'purchased_products' => $purchasedProducts,
            'orders_sum_price' => $ordersSum,
            'avg_bill' => $ordersSum/$validatedOrdersCount,
            'has_subscription_users' => User::where('has_subscription',true)->count(),
        ];
    }
}
