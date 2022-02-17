<?php

namespace App\Services\Helpers;

use App\Models\Product;
use App\Models\PromotionProduct;

/**
 * Class PromotionsServiceHelper
 * @package App\Services\Helpers
 */
class PromotionsServiceHelper
{
    /**
     * @param $productIds
     * @param $promotion
     */
    public function setProducts($productIds, $promotion)
    {
        $products = Product::whereIn('id', $productIds)
            ->get();

        $promotionProductInsert = [];
        foreach ($products as $product)
        {
            $promotionProductInsert[] = [
                'promotion_id' => $promotion->id,
                'product_id' => $product->id,
            ];

            $product->old_price = $product->price;
            $product->price =$this->countNewPrice($product->price, $promotion->percent);
            $product->save();
        }

        PromotionProduct::insert($promotionProductInsert);
    }

    /**
     * @param $price
     * @param $discount
     * @return float|int
     */
    protected function countNewPrice($price, $discount)
    {
        return ($price/100)*(100-$discount);
    }

    /**
     * @param $promotion
     * @return mixed
     */
    public function formForPush($promotion)
    {
        $t = strtotime($promotion->from_date);
        $promotion->fromDate = date('m.y',$t);
        $t = strtotime($promotion->to_date);
        $promotion->toDate = date('m.y',$t);


        $categories = $promotion->promotionProduct->pluck('product.categories.*.category.name')->unique()
            ->flatten();

        $brands = $promotion->promotionProduct->pluck('product.brand.name')->unique()
            ->flatten();

        $strCategories = $categories[0];
        for ($i = 1;$i < count($categories);$i++)
        {
            $strCategories .= ', '.$categories[$i];
        }

        $strBrands = $brands[0];
        for ($i = 1;$i < count($brands);$i++)
        {
            $strBrands .= ', '.$brands[$i];
        }

        $promotion->categories = $strCategories;
        $promotion->brands = $strBrands;

        return $promotion;
    }
}
