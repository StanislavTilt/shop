<?php

namespace App\Enums;

/**
 * Class OrderDeliveryStatusesEnum
 * @package App\Enums
 */
class OrderDeliveryStatusesEnum
{
    /**
     *
     */
    const WAITING_FOR_PAYMENT = 'waiting_for_payment';
    /**
     *
     */
    const PAID = 'paid';
    /**
     *
     */
    const ON_THE_WAY = 'on_the_way';
    /**
     *
     */
    const COMPLETED = 'completed';
    /**
     *
     */
    const CANCELED = 'canceled';

    /**
     * @return array
     */
    static public function all()
    {
        return [
            self::WAITING_FOR_PAYMENT,
            self::PAID,
            self::ON_THE_WAY,
            self::COMPLETED,
            self::CANCELED,
        ];
    }
}
