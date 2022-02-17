<?php


namespace App\Services;


use App\Models\Product;
use App\Models\QueryBuilder\Filters\AttributeFilter;
use App\Models\QueryBuilder\Filters\ColorFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchService
{
    const MAXIMUM_NUMBER_OF_RESULTS = 20;

    public function searchProducts(
        $request,
        array $allowedFields = [],
        array $relations = [],
        int $numberOfResults = 20
    ): LengthAwarePaginator
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'name',
                AllowedFilter::custom('size', new AttributeFilter())->ignore(null),
                AllowedFilter::custom('color', new ColorFilter())->ignore(null),
                AllowedFilter::exact('categories', 'categories.id')->ignore(null),
                AllowedFilter::exact('brand', 'brand_id')->ignore(null),
                AllowedFilter::scope('price_from')->ignore(null),
                AllowedFilter::scope('price_to')->ignore(null),
            ])->active();

        if (!empty($allowedFields)) {
            $products = $products->allowedFields($allowedFields);
        }

        if (!empty($relations)) {
            $products = $products->with($relations);
        }

        if ($numberOfResults > self::MAXIMUM_NUMBER_OF_RESULTS) {
            $numberOfResults = self::MAXIMUM_NUMBER_OF_RESULTS;
        }

        $sortKey = $request->get('sort_key', 'created_at');
        $sortMethod = $request->get('sort_method', 'asc');

        $products = $products->orderBy($sortKey, $sortMethod);

        return $products->paginate($numberOfResults);
    }
}
