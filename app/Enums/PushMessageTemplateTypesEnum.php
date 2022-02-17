<?php
/**
 * Created by PhpStorm.
 * User: stasi
 * Date: 16.02.2022
 * Time: 16:40
 */

namespace App\Enums;


/**
 * Class PushMessageTemplateTypesEnum
 * @package App\Enums
 */
class PushMessageTemplateTypesEnum
{
    /**
     *
     */
    const NEW_PROMOTION = 'promotion';
    /**
     *
     */
    const ORDER_CHANGE_STATUS = 'order-screen';

    /**
     *
     */
    const ORDER_HISTORY = 'order-history';
    /**
     *
     */
    const CART = 'cart';
    /**
     *
     */
    const CURRENT_PRODUCT = 'product_detail';
    /**
     *
     */
    const PRODUCTS_BY_STOREFRONT = 'storefront-products';
    /**
     *
     */
    const PRODUCTS_BY_BRAND = 'brand-products';
    /**
     *
     */
    const PRODUCTS_BY_CATEGORY = 'products-by-categories';

    /**
     * @return array
     */
    static public function availableToSendPush()
    {
        return [
            self::CURRENT_PRODUCT,
            self::CART,
            self::ORDER_HISTORY,
            self::PRODUCTS_BY_BRAND,
            self::PRODUCTS_BY_CATEGORY,
            self::PRODUCTS_BY_STOREFRONT,
        ];
    }
}
