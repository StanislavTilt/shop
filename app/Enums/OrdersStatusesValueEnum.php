<?php

namespace App\Enums;

use App\ValueObjects\Order\OrderStatus;

class OrdersStatusesValueEnum
{
    const WAITING_FOR_PAYMENT = 'waiting_for_payment';
    const DECLINED = 'declined';
    const PAYED = 'payed';

    const KEYS = [
        OrderStatus::WAITING_FOR_PAYMENT => self::WAITING_FOR_PAYMENT,
        OrderStatus::DECLINED => self::DECLINED,
        OrderStatus::PAYED => self::PAYED,
    ];

    static public function all()
    {
        return self::KEYS;
    }

    static public function keysValue()
    {
        return [
            self::WAITING_FOR_PAYMENT => OrderStatus::WAITING_FOR_PAYMENT,
            self::DECLINED => OrderStatus::DECLINED,
            self::PAYED => OrderStatus::PAYED,
        ];
    }
}
