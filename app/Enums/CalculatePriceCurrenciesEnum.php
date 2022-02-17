<?php

namespace App\Enums;

/**
 * Class CalculatePriceCurrenciesEnum
 * @package App\Enums
 */
class CalculatePriceCurrenciesEnum
{
    /**
     *
     */
    const EURO_CURRENCY = 'EUR';
    /**
    *
    */
    const DOLLAR_CURRENCY = 'USD';
    /**
     *
     */
    const RUBLE_CURRENCY = 'RUB';

    /**
     * @return array
     */
    static public function all()
    {
        return [
            self::EURO_CURRENCY,
            self::RUBLE_CURRENCY,
            self::DOLLAR_CURRENCY,
        ];
    }
}
