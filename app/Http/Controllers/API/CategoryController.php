<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 */
class CategoryController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters([
                AllowedFilter::scope('root', 'whereRoot')->ignore(null),
            ])
            ->allowedIncludes([
                'children'
            ])
            ->orderBy('order')
            ->whereActive()
            ->get();

        return CategoryResource::collection($categories);
    }

    /**
     * @param $id
     * @return CategoryResource
     */
    public function getById($id): CategoryResource
    {
        $category = Category::with('children')->find($id);

        return new CategoryResource($category);
    }
}
