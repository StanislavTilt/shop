<?php

namespace App\Enums;


/**
 * Class OrderReportProperties
 * @package App\Enums
 */
class OrderReportProperties
{
    /**
     *
     */
    const LOCAL = 'order_report.';

    //Проблемы с продуктом
    /**
     *
     */
    const FAKE = 'fake';
    /**
     *
     */
    const DAMAGED = 'damaged';
    /**
     *
     */
    const NOT_DELIVERED = 'not_delivered';
    /**
     *
     */
    const NOT_MATCH_DESCRIPTION = 'not_match_description';
    /**
     *
     */
    const INC_QUANTITY = 'inc_quantity';

    //Действия
    /**
     *
     */
    const REFUND = 'refund';
    /**
     *
     */
    const PARTIAL_REFUND = 'partial_refund';
    /**
     *
     */
    const SUBSTITUTION = 'substitution';


    /**
     *
     */
    const TROUBLES = [
        self::LOCAL.self::FAKE,
        self::LOCAL.self::DAMAGED,
        self::LOCAL.self::NOT_DELIVERED,
        self::LOCAL.self::NOT_MATCH_DESCRIPTION,
        self::LOCAL.self::INC_QUANTITY,
    ];

    /**
     *
     */
    const ACTIONS = [
        self::LOCAL.self::REFUND,
        self::LOCAL.self::PARTIAL_REFUND,
        self::LOCAL.self::SUBSTITUTION
    ];
}
