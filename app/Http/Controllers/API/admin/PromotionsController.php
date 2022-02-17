<?php

namespace App\Http\Controllers\Api\admin;

use App\Enums\PushMessageTemplateTypesEnum;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\CreatePromotionRequest;
use App\Http\Requests\Admin\SearchPromotionsRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Http\Resources\Admin\PromotionResource;
use App\Models\Promotion;
use App\Models\Promotionable;
use App\Models\User;
use App\Services\FileUpload;
use App\Services\Helpers\PromotionsServiceHelper;
use App\Services\Helpers\PushMessageHelperService;

/**
 * Class PromotionsController
 * @package App\Http\Controllers\Api\admin
 */
class PromotionsController extends BaseApiController
{

    protected $pushMessageHelper;
    /**
     * @var PromotionsServiceHelper
     */
    protected $helperService;

    /**
     * @var FileUpload
     */
    protected $fileUploadService;

    /**
     * PromotionsController constructor.
     * @param PromotionsServiceHelper $helperService
     * @param FileUpload $service
     */
    public function __construct(PromotionsServiceHelper $helperService, FileUpload $service, PushMessageHelperService $pushMessageHelper)
    {
        parent::__construct();
        $this->helperService = $helperService;
        $this->fileUploadService = $service;
        $this->fileUploadService->baseFolder = 'promotion_icons';
        $this->pushMessageHelper = $pushMessageHelper;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $promotions = Promotion::all()
            ->load([
                'promotionProduct.product.brand',
                'promotionProduct.product.tags',
                'promotionProduct.product.categories'
            ]);
        return PromotionResource::collection($promotions);
    }

    /**
     * @param CreatePromotionRequest $request
     * @return mixed
     */
    public function create(CreatePromotionRequest $request)
    {
        $requestData = $request->only([
            'title',
            'description',
            'percent',
            'from_date',
            'to_date'
        ]);

        $requestData['is_active'] = true;

        if (isset($request->image)) {
            $requestData['image'] = $this->fileUploadService->saveFile($request, 'image');
        }

        $promotion = Promotion::create($requestData);

        $this->helperService->setProducts($request->get('products_ids'), $promotion);

        $promotion = $promotion->load([
            'promotionProduct.product.brand',
            'promotionProduct.product.tags',
            'promotionProduct.product.categories.category'
        ]);

        if($request->from_date <= now())
        {
            $userFcmTokens = User::where('device_key', '<>', null)
                ->get()
                ->pluck('device_key')->all();

            $promotion = $this->helperService->formForPush($promotion);

            $this->pushMessageHelper
                ->sendPush($userFcmTokens, PushMessageTemplateTypesEnum::NEW_PROMOTION, $promotion);
        }

        return PromotionResource::make($promotion);
    }

    /**
     * @param SearchPromotionsRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(SearchPromotionsRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'asc');

        $promotions = Promotion::orderBy($sortKey, $sortMethod)
            ->with(['promotionProduct.product.brand', 'promotionProduct.product.tags', 'promotionProduct.product.categories']);

        if (isset($request->id)) {
            $promotions = $promotions->where('id', $request->id);
        }
        if (isset($request->title)) {
            $promotions = $promotions->where('title', 'like', '%' . $request->title . '%');
        }
        if (isset($request->from_date)) {
            $promotions = $promotions->where('from_date', 'like', '%' . $request->from_date . '%');
        }
        if (isset($request->to_date)) {
            $promotions = $promotions->where('to_date', 'like', '%' . $request->to_date . '%');
        }

        return PromotionResource::collection($promotions->paginate(10));
    }

    /**
     * @param Promotion $promotion
     * @return PromotionResource
     */
    public function show(Promotion $promotion)
    {
        return PromotionResource::make($promotion->load([
            'promotionProduct.product.brand',
            'promotionProduct.product.tags',
            'promotionProduct.product.categories'
        ]));
    }

    /**
     * @param UpdatePromotionRequest $request
     * @param Promotion $promotion
     * @return PromotionResource
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $requestData = $request->only([
            'title',
            'description',
            'percent',
            'from_date',
            'to_date',
            'is_active',
        ]);

        if (isset($request->image)) {
            $requestData['image'] = $this->fileUploadService->saveFile($request, 'image', 'update', $promotion->image);
        }

        $promotion->update($requestData);

        if(isset($request->product_ids))
        {
            $promotion->promotionProduct()->delete();
            $this->helperService->setProducts($request->product_ids, $promotion);
        }

        return PromotionResource::make($promotion->load([
            'promotionProduct.product.brand',
            'promotionProduct.product.tags',
            'promotionProduct.product.categories'
        ]));
    }

    /**
     * @param Promotion $promotion
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->promotionProduct()->delete();
        Promotionable::where('promotion_id', $promotion->id)->delete();
        $promotion->delete();
        return $this->getSuccessResponse(200);
    }
}
