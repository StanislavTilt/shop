<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchProductResource;
use App\Services\SearchService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{
    public function __invoke(SearchService $searchService): AnonymousResourceCollection
    {
        $product = $searchService->searchProducts(['id', 'name'], [], 5);

        return SearchProductResource::collection($product);
    }
}
