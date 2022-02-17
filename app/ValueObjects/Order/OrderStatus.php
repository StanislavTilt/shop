<?php


namespace App\ValueObjects\Order;


class OrderStatus extends \App\ValueObjects\BaseValueObject
{
    const WAITING_FOR_PAYMENT = 0;

    const DECLINED = 1;

    const PAYED = 2;

    public static function all(): array
    {
        return [
            self::WAITING_FOR_PAYMENT,
            self::DECLINED,
            self::PAYED
        ];
    }
}
