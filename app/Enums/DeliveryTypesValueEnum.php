<?php

namespace App\Enums;

use App\ValueObjects\Order\DeliveryType;

class DeliveryTypesValueEnum
{
    const KEYS = [
        DeliveryType::PICKUP => 'pickup',
        DeliveryType::CDEK => 'cdek',
        DeliveryType::RUSSIAN_MAIL => 'russian_mail',
    ];
}
