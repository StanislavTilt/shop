<?php

namespace App\Http\Controllers\API\admin;

use App\Enums\CalculatePriceCurrenciesEnum;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\SearchProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Requests\GetCalculatedPriceRequest;
use App\Http\Resources\ProductResource;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Country;
use App\Models\CurrencyCost;
use App\Models\Location;
use App\Models\OtherServerSetting;
use App\Models\Product;
use App\Models\Season;
use App\Models\Storefront;
use App\Models\Tag;
use App\Models\Vendor;
use App\Services\Admin\ProductService;
use App\Services\Helpers\ProductHelperService;
use Database\Seeders\OtherServerSettingsSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProductController
 * @package App\Http\Controllers\API\admin
 */
class ProductController extends BaseApiController
{
    /**
     * @var ProductService
     */
    protected $productService;

    protected $productHelperService;

    /**
     * ProductController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service, ProductHelperService $productHelperService)
    {
        parent::__construct();
        $this->productService = $service;
        $this->productHelperService = $productHelperService;
    }

    /**
     * @param CreateProductRequest $request
     * @return mixed
     */
    public function create(CreateProductRequest $request)
    {
        $product = $this->productService->createProduct($request, Auth::user());
        return $product;
    }

    /**
     * @return Tag[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllTags()
    {
        return Tag::all();
    }

    /**
     * @return Attribute[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllAttributes()
    {
        return Attribute::all()
            ->load(['options']);
    }

    /**
     * @param SearchProductRequest $request
     * @return mixed
     */
    public function searchProducts(SearchProductRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'asc');

        $products = Product::orderBy($sortKey, $sortMethod)
            ->with(['brand', 'categories.category', 'storefronts.storefront', 'productOptions.color', 'promotionProduct.promotion']);

        if(isset($request->id))
        {
            $products = $products->where('id', $request->id);
        }
        if(isset($request->name))
        {
            $products = $products->where('name', 'like', '%'.$request->name.'%');
        }
        if(isset($request->category))
        {
            $category = $request->category;
            $products = $products->whereHas('categories', function (Builder $query) use ($category) {
                $query->whereHas('category', function (Builder $query) use ($category) {
                    $query->where('name', 'like', '%'.$category.'%');
                });
            });
        }
        if(isset($request->brand))
        {
            $products = $products->whereHas('brand', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->brand.'%');
            });
        }

        return ProductResource::collection($products->paginate(10));
    }

    /**
     * @param $productId
     * @return mixed
     */
    public function show($productId)
    {
        $product = Product::where('id', $productId)
            ->with(['categories.category', 'brand', 'tags', 'productOptions.color', 'storefronts.storefront','productSeasons.season', 'adminProduct.admin'])
            ->firstOrFail();
        $product->images = $product->getMedia('productImage');
        return $product;
    }

    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return Product|mixed
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = $this->productService->updateProduct($request, $product);
        return $product;
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Product $product)
    {
        $product->deleteRelations();
        $product->delete();
        return $this->getSuccessResponse(200);
    }

    /**
     * @return array
     */
    public function getDataForProduct()
    {
        return [
            'brands' => Brand::all(),
            'tags' => Tag::all(),
            'colors' => Color::all(),
            'seasons' => Season::all(),
            'categories' => Category::all()->load('children'),
            'storefronts' => Storefront::all(),
            'countries' => Country::all(),
            'vendors' => Vendor::all(),
        ];
    }

    /**
     * @param GetCalculatedPriceRequest $request
     * @return float|int|mixed
     */
    public function getCalculatedPrice(GetCalculatedPriceRequest $request)
    {
        $location = Location::whereHas('country', function (Builder $query) use ($request){
            $query->where('name',$request->country);
        })->with(['currencyCost', 'locationSetting'])
            ->first();
        return $this->productHelperService->countPrice($location, $request->validated());
    }
}
