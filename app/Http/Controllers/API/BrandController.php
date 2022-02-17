<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Brand;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedInclude;
use App\Models\QueryBuilder\Includes\LimitInclude;
use App\Models\QueryBuilder\Filters\AttributeFilter;

/**
 * Class BrandController
 * @package App\Http\Controllers\API
 */
class BrandController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        $brands = QueryBuilder::for(Brand::class)
            ->allowedFilters([
                AllowedFilter::scope('main', 'whereMain')->ignore(null),
            ])
            ->allowedIncludes([
                'productsCount',
                AllowedInclude::custom('products', new LimitInclude(3))
            ])
            ->whereActive()
            ->get();

        return BrandResource::collection($brands);
    }
}
