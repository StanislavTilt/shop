<?php


namespace App\ValueObjects\Order;


use App\ValueObjects\BaseValueObject;

class PaymentType extends BaseValueObject
{
    const CASH = 0;

    const ONLINE = 1;

    public static function all(): array
    {
        return [
            self::CASH,
            self::ONLINE
        ];
    }
}
