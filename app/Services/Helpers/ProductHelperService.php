<?php
/**
 * Created by PhpStorm.
 * User: stasi
 * Date: 31.01.2022
 * Time: 22:14
 */

namespace App\Services\Helpers;


use App\Enums\CalculatePriceCurrenciesEnum;
use App\Models\OtherServerSetting;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\ProductSeason;
use App\Models\ProductStorefront;
use App\Models\ProductTag;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class ProductHelperService
 * @package App\Services\Helpers
 */
class ProductHelperService
{
    /**
     * @param $product
     * @return mixed
     */
    public function getFormOptions($product)
    {
        $sizes = $product->productOptions->pluck('size')
            ->unique()
            ->flatten();
        $optionsReturn = [];
        foreach ($sizes as $size) {
            $colors = $product->productOptions->where('size', $size);
            $colorsReturn = [];

            foreach ($colors as $color) {
                $colorsReturn[] = [
                    'option_id' => $color->id,
                    'quantity' => $color->quantity,
                    'id' => $color->color->id,
                    'name' => $color->color->name,
                    'key' => $color->color->key,
                    'hex' => $color->color->hex,
                    'created_at' => $color->color->created_at,
                    'updated_at' => $color->color->updated_at,
                ];
            }


            $optionsReturn[] = [
                'size' => $size,
                'colors' => $colorsReturn
            ];
        }

        $product->options = $optionsReturn;

        return $product;
    }

    /**
     * @param $price
     * @param $locationAllowance
     * @return float|int
     */
    protected function countLocationAllowance($price, $locationAllowance)
    {
        return ($price * (1+$locationAllowance/100))-$price;
    }

    /**
     * @param $kilogramPrice
     * @param $currencyCost
     * @return float|int
     */
    protected function countKilogramPrice($kilogramPrice, $currencyCost)
    {
        return $kilogramPrice * $currencyCost;
    }

    /**
     * @param $weight
     * @param $kilogramPrice
     * @return float|int
     */
    protected function countWeightCost($weight, $kilogramPrice)
    {
        return ($weight/1000) * $kilogramPrice;
    }

    /**
     * @param $price
     * @param $locationAllowance
     * @param $weightCost
     * @param $currencyChangeCommission
     * @return float|int
     */
    protected function countFinalPrice($price, $locationAllowance, $weightCost, $currencyChangeCommission)
    {
        return ($price+$locationAllowance+$weightCost)*1+$currencyChangeCommission;
    }

    /**
     * @param $location
     * @param $requestData
     * @return float|int
     */
    public function countPrice($location, $requestData)
    {
        $price = $requestData['price'];
        $weight = $requestData['weight'];
        if($requestData['currency'] != CalculatePriceCurrenciesEnum::RUBLE_CURRENCY)
        {
            $price =  $location->currencyCost->value * $price;
        }
        $locationAllowance = $this->countLocationAllowance($price, $location->locationSetting->allowance);
        $kilogramPrice = $this->countKilogramPrice($location->locationSetting->kilogram_price, $location->currencyCost->value);
        $weightCost = $this->countWeightCost($weight, $kilogramPrice);

        $currencyChangeCommission = OtherServerSetting::getSettingValue(OtherServerSetting::CURRENCY_CONVERSION_COMMISSION);

        $finalPrice = $this->countFinalPrice($price, $locationAllowance, $weightCost, $currencyChangeCommission);
        return round($finalPrice);
    }

    /**
     * @param $request
     * @param $product
     * @param $method
     * @return mixed
     */
    public function setProductRelations($request, $product, $method = 'create')
    {
        if(isset($request->options))
        {
            if($method == 'update')
            {
                ProductOption::where('product_id',$product->id)->delete();
            }
            $optionsInsert = [];
            foreach ($request->options as $option)
            {
                $optionsInsert[] = [
                    'color_id' => $option['color_id'],
                    'product_id' => $product->id,
                    'size' => $option['size'],
                    'quantity' => $option['quantity'],
                ];
            }
            ProductOption::insert($optionsInsert);
        }

        if(isset($request->tags))
        {
            $tags = array_unique($request->tags);
            if($method == 'update')
            {
                ProductTag::where('product_id', $product->id)
                    ->delete();
            }
            $tagsInsert = [];
            foreach ($tags as $tag)
            {
                $tagsInsert[] = [
                    'product_id' => $product->id,
                    'tag_id' => $tag,
                ];
            }
            ProductTag::insert($tagsInsert);
        }

        if(isset($request->photos) || isset($request->video))
        {
            if($method == 'update')
            {
                Media::where('model_type', 'products')
                    ->where('model_id', $product->id)
                    ->delete();
            }
            if(isset($request->photos))
            {
                for($i = 0;$i<count($request->photos);$i++)
                {
                    $product->addMediaFromRequest('photos.'.$i)
                        ->toMediaCollection('productImage');
                }
            }

            if(isset($request->video))
            {
                $product->addMediaFromRequest('video')
                    ->toMediaCollection('productImage');
            }

        }


        if(isset($request->storefronts))
        {
            if($method == 'update')
            {
                ProductStorefront::where('product_id', $product->id)
                    ->delete();
            }
            $productStorefrontInsert = [];
            foreach ($request->storefronts as $storefront)
            {
                if($storefront['value'])
                {
                    if(isset($request->expired_at))
                    {
                        $productStorefrontInsert[] = [
                            'storefront_id' => $storefront['id'],
                            'product_id' => $product->id,
                            'expired_at' => $request->expired_at
                        ];
                    }
                }
            }
            ProductStorefront::insert($productStorefrontInsert);
        }

        if(isset($request->season_ids))
        {
            $seasons = array_unique($request->season_ids);
            if($method == 'update')
            {
                ProductSeason::where('product_id', $product->id)
                    ->delete();
            }
            $seasonsInsert = [];
            foreach ($seasons as $season_id) {
                $seasonsInsert[] = [
                    'product_id' => $product->id,
                    'season_id' => $season_id
                ];
            }
            ProductSeason::insert($seasonsInsert);
        }

        if(isset($request->categories))
        {
            $categories = array_unique($request->categories);
            if($method == 'update')
            {
                ProductCategory::where('product_id', $product->id)
                    ->delete();
            }
            $categoriesInsert = [];
            foreach ($categories as $category) {
                $categoriesInsert[] = [
                    'category_id' => $category,
                    'product_id' => $product->id,
                ];
            }
            ProductCategory::insert($categoriesInsert);
        }
        return $product;
    }
}
