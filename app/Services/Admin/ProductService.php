<?php

namespace App\Services\Admin;

use App\Models\AdminProduct;
use App\Models\Pivot\Optionable;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\ProductSeason;
use App\Models\ProductStorefront;
use App\Models\ProductTag;
use App\Models\Promotion;
use App\Services\Helpers\ProductHelperService;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class ProductService
 * @package App\Services\Admin
 */
class ProductService
{
    /**
     * @var ProductHelperService
     */
    protected  $productHelperService;

    /**
     * ProductService constructor.
     */
    public function __construct()
    {
        $this->productHelperService = new ProductHelperService();
    }

    /**
     * @param $request
     * @param $admin
     * @return mixed
     */
    public function createProduct($request, $admin)
    {
        $dataForProduct = $request->only([
            'name',
            'description',
            'old_price',
            'price',
            'expired_at',
            'categories',
            'brand_id',
            'status',
            'purchase_price',
            'purchase_price_currency',
            'region',
            'weight',
            'vendor_id',
            'features',
        ]);
        $dataForProduct['quantity'] = 0;
        $dataForProduct['removal_time'] = $request->expired_at;
        foreach ($request->options as $option)
        {
            $dataForProduct['quantity'] += $option['quantity'];
        }
        $product = Product::create($dataForProduct);

        $this->productHelperService->setProductRelations($request, $product);

        AdminProduct::create([
            'product_id' => $product->id,
            'admin_id' => $admin->id,
        ]);

        return $product->load(['brand', 'vendor','tags', 'categories', 'storefronts', 'productSeasons.season','adminProduct.admin', 'productOptions']);
    }

    /**
     * @param $request
     * @param $product
     * @return mixed
     */
    public function updateProduct($request, $product)
    {
        $dataForProduct = $request->only([
            'name',
            'description',
            'old_price',
            'price',
            'expired_at',
            'categories',
            'brand_id',
            'status',
            'purchase_price',
            'purchase_price_currency',
            'region',
            'weight',
            'vendor_id',
            'features',
        ]);

        $dataForProduct['removal_time'] = $request->expired_at;

        $product->update($dataForProduct);

        $this->productHelperService->setProductRelations($request, $product, 'update');

        return $product->load(['brand', 'vendor','tags', 'categories', 'storefronts', 'productSeasons.season','adminProduct.admin', 'productOptions']);
    }
}
