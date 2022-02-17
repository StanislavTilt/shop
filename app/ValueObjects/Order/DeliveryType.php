<?php


namespace App\ValueObjects\Order;


use App\ValueObjects\BaseValueObject;

class DeliveryType extends BaseValueObject
{
    const PICKUP = 0;

    const CDEK = 1;

    const RUSSIAN_MAIL = 2;

    public static function all(): array
    {
        return [
            self::PICKUP,
            self::CDEK,
            self::RUSSIAN_MAIL,
        ];
    }
}
