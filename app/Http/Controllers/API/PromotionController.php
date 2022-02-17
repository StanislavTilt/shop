<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PromotionController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        return PromotionResource::collection(
            Promotion::whereActive()
                ->where('from_date', '<=', now())
                ->get()
        );
    }

    /**
     * @param $id
     * @return PromotionResource
     */
    public function getById($id): PromotionResource
    {
        $promotion = Promotion::with(['promotionProduct.product','promotionProduct.product.brand','promotionProduct.product.tags', 'promotionProduct.product.categories'])
            ->whereActive()
            ->where('from_date', '<=', now())
            ->findOrFail($id);

        return new PromotionResource($promotion);
    }
}
