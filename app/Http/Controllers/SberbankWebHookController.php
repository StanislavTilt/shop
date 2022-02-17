<?php

namespace App\Http\Controllers;

use App\Enums\OrderDeliveryStatusesEnum;
use App\Http\Controllers\API\BaseApiController;
use App\Models\Order;
use App\Models\ProductOption;
use App\ValueObjects\Order\OrderStatus;
use App\ValueObjects\Order\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class SberbankWebHookController
 * @package App\Http\Controllers
 */
class SberbankWebHookController extends BaseApiController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $orderUuid = $request->get('mdOrder');
        $order = Order::where('order_uuid', $orderUuid)
            ->with('orderProduct')
            ->first();
        if($request->get('status'))
        {
            $order->update([
                'payment_time' => now(),
                'status' => OrderStatus::PAYED,
                'delivery_status' => OrderDeliveryStatusesEnum::PAID
            ]);
        }
        else
        {
            foreach ($order->orderProduct as $orderProduct)
            {
                ProductOption::where('id', $orderProduct->product_option_id)
                    ->increment('quantity', $orderProduct->quantity);
            }
            $order->update([
                'status' => OrderStatus::DECLINED,
                'delivery_status' => OrderDeliveryStatusesEnum::CANCELED
            ]);
        }
    }
}
