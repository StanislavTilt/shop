<?php
/**
 * Created by PhpStorm.
 * User: stasi
 * Date: 13.01.2022
 * Time: 18:08
 */

namespace App\Enums;


use App\ValueObjects\Order\PaymentType;

class PaymentTypeKeysEnum
{
    const KEYS = [
        PaymentType::CASH => 'cash',
        PaymentType::ONLINE => 'online',
    ];
}
