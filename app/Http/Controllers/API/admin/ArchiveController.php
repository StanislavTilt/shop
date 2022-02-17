<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\ReturnProductToStorefrontRequest;
use App\Http\Resources\ProductResource;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSeason;
use App\Models\ProductStorefront;
use App\Models\ProductTag;

/**
 * Class ArchiveController
 * @package App\Http\Controllers\Api\admin
 */
class ArchiveController extends BaseApiController
{
    /**
     * ArchiveController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllArchiveProducts()
    {
        $products = Product::where('status', Product::STATUS_DEACTIVE)
            ->with(['brand', 'options', 'tags', 'categories', 'storefronts' ,'promotions'])
            ->get();
        return ProductResource::collection($products);
    }

    /**
     * @param ReturnProductToStorefrontRequest $request
     * @return ProductResource
     */
    public function returnToStore(ReturnProductToStorefrontRequest $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->update(['status' => Product::STATUS_ACTIVE, 'removal_time' => null]);

        $storefrontsInsert = [];
        foreach ($request->storefront_ids as $id)
        {
            $storefrontsInsert[] = [
                'product_id' => $product->id,
                'storefront_id' => $id,
                'expired_at' => $request->expired_at
            ];
        }

        ProductStorefront::insert($storefrontsInsert);

        return ProductResource::make($product->load(['brand', 'options', 'tags', 'categories', 'storefronts' ,'promotions']));
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        ProductCategory::where('product_id', $product->id)
            ->delete();
        ProductSeason::where('product_id', $product->id)
            ->delete();
        OrderProduct::where('product_id', $product->id)
            ->delete();
        ProductStorefront::where('product_id', $product->id)
            ->delete();
        ProductTag::where('product_id', $product->id)
            ->delete();
        $product->delete();
    }
}
