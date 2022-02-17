<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\OrderReportProperties;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreOrderReportRequest;
use App\Http\Resources\Admin\OrderReportResource;
use App\Models\OrderReport;
use App\Models\OrderReportImage;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrderReportController
 * @package App\Http\Controllers\Api\User
 */
class OrderReportController extends BaseApiController
{
    /**
     * @var FileUpload
     */
    protected $fileUploadService;

    /**
     * CategoryController constructor.
     * @param FileUpload $service
     */
    public function __construct(FileUpload $service)
    {
        parent::__construct();
        $this->fileUploadService = $service;
        $this->fileUploadService->baseFolder = 'order_report_images';
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessagesToStoreOrderReport()
    {
        $troubleMessageKeys = OrderReportProperties::TROUBLES;
        $troubleTexts = [];
        foreach ($troubleMessageKeys as $key)
        {
            $troubleTexts[] = __($key);
        }

        $actionMessageKeys = OrderReportProperties::ACTIONS;
        $actionTexts = [];
        foreach ($actionMessageKeys as $key)
        {
            $actionTexts[] = __($key);
        }

        return $this->getResponse([
            'troubles' => $troubleTexts,
            'actions' => $actionTexts,
        ]);
    }

    /**
     * @param StoreOrderReportRequest $request
     * @return OrderReportResource
     */
    public function store(StoreOrderReportRequest $request)
    {
        $attributes = $request->validated();
        $attributes['author_id'] = Auth::user()->id;

        $orderReport = OrderReport::create($attributes);

        if(isset($request->images) > 0)
        {
            $orderImagesInsert = [];
            foreach ($attributes['images'] as $key => $arr)
            {
                $orderImagesInsert[] = [
                    'order_report_id' => $orderReport['id'],
                    'image' => $this->fileUploadService->saveFile($request, 'images.'.$key),
                ];
            }
            OrderReportImage::insert($orderImagesInsert);
        }

        return OrderReportResource::make($orderReport->load('images'));
    }
}
