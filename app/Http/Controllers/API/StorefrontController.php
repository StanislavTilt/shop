<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StorefrontResource;
use App\Models\Storefront;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class StorefrontController
 * @package App\Http\Controllers\API
 */
class StorefrontController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        return StorefrontResource::collection(
            Storefront::withCount('products')->get()
        );
    }

    /**
     * @param $id
     * @return StorefrontResource
     */
    public function getById($id): StorefrontResource
    {
        $storefront = Storefront::withCount('products')
            ->with('products.tags')
            ->findOrFail($id);

        return new StorefrontResource($storefront);
    }
}
