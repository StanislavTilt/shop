<?php

namespace App\Services;

use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderChange;
use App\Models\Pivot\Optionable;
use App\Models\ProductOption;
use App\Models\User;
use App\ValueObjects\Order\OrderStatus;
use App\ValueObjects\Order\PaymentType;

class OrderService
{
    public function createOrder(User $user, array $payload)
    {
        $order = $user->orders()->create($payload);

        /** @var CartProduct[] $cartProducts */
        $cartProducts = $user->cart->products;
        $orderSum = 0;
        foreach ($cartProducts as $cartProduct) {
            $productOption = ProductOption::where('id', $cartProduct->product_option_id)
                ->firstOrFail();

            if($productOption->quantity < $cartProduct->quantity)
            {
                return __('order_errors.not_enough_stock');
            }

            $product = $cartProduct->product;
            $product->quantity -= $cartProduct->quantity;
            $productOption->quantity -= $cartProduct->quantity;
            $productOption->save();


            $order->orderProduct()->create([
                'quantity' => $cartProduct->quantity,
                'product_option_id' => $cartProduct->product_option_id,
                'price' => $product->price,
                'product_id' => $product->id,
                'order_id' => $order->id
            ]);

            $orderSum += $product->price;

            $product->save();
            $cartProduct->delete();
        }
        OrderChange::create([
            'order_id' => $order->id,
            'new_status' => OrderStatus::WAITING_FOR_PAYMENT,
            'system_change' => true,
        ]);



        if($order->payment_type == PaymentType::ONLINE)
        {
            /* Сумма заказа в копейках */
            $vars['amount'] = $orderSum * 100;

            $token = config('sber-data.token');
            if(!$token)
            {
                $username = config('sber-data.username');
                $password = config('sber-data.password');
                $vars['userName'] = $username;
                $vars['password'] = $password;
            }
            else {
                $vars['token'] = $token;
            }

            $vars['returnUrl'] = 'http://example.com/success/'; //TODO success url
            $vars['failUrl'] = 'http://example.com/error/';  //TODO error url
            $vars['orderNumber'] = $order->id+999949422994321; //TODO for test

            $ch = curl_init('https://3dsec.sberbank.ru/payment/rest/register.do?' . http_build_query($vars));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($res, true);
            $order->update(['order_uuid' => $res['orderId']]);
            return $res;
        }
    }

    /**
     * @param Order $order
     * @param array $validated
     */
    public function updateOrder(Order $order, array $validated)
    {
        $order->update($validated);
    }
}
