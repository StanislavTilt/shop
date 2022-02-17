<?php
/**
 * Created by PhpStorm.
 * User: stasi
 * Date: 31.01.2022
 * Time: 22:29
 */

namespace App\Services\Helpers;


use App\Models\Order;

/**
 * Class OrderHelperService
 * @package App\Services\Helpers
 */
class OrderHelperService
{
    /**
     * @param Order $order
     * @return float|int
     */
    public function countSummaryPrice(Order $order)
    {
        $costs = $order->orderProduct->pluck('product.price')->toArray();
        return array_sum($costs);
    }

    /**
     * @param $key
     * @return array|null|string
     */
    static public function getStatusValue($key)
    {
        return __('order_keys.'.$key);
    }
}
