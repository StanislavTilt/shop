<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchProductsRequest;
use App\Http\Requests\GetAvailableFiltersRequest;
use App\Http\Requests\ReceiveProductsAfterDateRequest;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductShortResource;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductOption;
use App\Services\Helpers\ProductHelperService;
use App\Services\SearchService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ProductController
 * @package App\Http\Controllers\API
 */
class ProductController extends Controller
{
    /**
     * @var SearchService
     */
    protected $searchService;

    protected $productHelperService;

    /**
     * ProductController constructor.
     * @param SearchService $searchService
     * @param ProductHelperService $productHelperService
     */
    public function __construct(SearchService $searchService, ProductHelperService $productHelperService)
    {
        $this->searchService = $searchService;
        $this->productHelperService = $productHelperService;
    }

    /**
     * @param SearchProductsRequest $request
     * @return AnonymousResourceCollection
     */
    public function getAll(SearchProductsRequest $request): AnonymousResourceCollection
    {
        $products = $this->searchService->searchProducts($request, [], ['tags']);

        return ProductShortResource::collection($products);
    }

    /**
     * @param ReceiveProductsAfterDateRequest $request
     * @return AnonymousResourceCollection
     */
    public function getCreatedAfterDate(ReceiveProductsAfterDateRequest $request): AnonymousResourceCollection
    {
        $timestamp = $request->validated()['timestamp'];

        $products = Product::where('created_at', '>', $timestamp)
            ->active()
            ->get(['id']);

        return ProductResource::collection($products);
    }

    /**
     * @param $id
     * @return ProductResource
     */
    public function getProductById($id): ProductResource
    {
        $product = Product::with([
            'categories',
            'tags',
            'brand',
            'promotions',
            'productSeasons.season',
            'productOptions.color'
        ])
            ->findOrFail($id);
        $product = $this->productHelperService->getFormOptions($product);
        return new ProductResource($product);
    }

    /**
     * @param GetAvailableFiltersRequest $request
     * @return array
     */
    public function getAvailableFilters(GetAvailableFiltersRequest $request): array
    {
        $categoryId = $request->get('category_id');
        $brandId = $request->get('brand_id');
        $name = $request->get('name');

        $products = Product::with('brand', 'productOptions.color')
            ->has('brand');


        if(isset($categoryId))
        {
            $products = $products->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('categories', function (Builder $query) use ($categoryId) {
                    $query->where('id', $categoryId);
                });
            });
        }

        if(isset($brandId))
        {
            $products = $products->where('brand_id', $brandId);
        }

        if(isset($name))
        {
            $products = $products->where('name', 'like',  '%'.$name.'%');
        }

        $products = $products->active()->get(['id', 'brand_id', 'price']);

        $brands = Brand::whereIn(
            'id',
            $products->pluck('brand.id')->unique()
        )->get(['id', 'name']);

        $sizes = $products->pluck('productOptions.*.size')
            ->unique()
            ->flatten()
            ->toArray();

        $sizes = array_values(array_unique($sizes));

        $optionsReturn = [];
        $options = ProductOption::whereIn('product_id',$products->pluck('id'))
            ->with('color')
            ->get();
        foreach ($sizes as $size)
        {
            $colors = $options->where('size',$size)->pluck('color')
                ->unique()
                ->flatten();
            $optionsReturn[] = [
                'size' => $size,
                'colors' => $colors
            ];
        }

        return [
            'brands' => BrandResource::collection($brands),
            'lowest_price' => $products->min('price'),
            'options' => $optionsReturn,
            'highest_price' => $products->max('price'),
        ];
    }
}
