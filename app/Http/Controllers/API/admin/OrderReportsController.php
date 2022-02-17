<?php

namespace App\Http\Controllers\Api\admin;

use App\Enums\OrderReportStatusesEnum;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\OrderReportChangeStatusRequest;
use App\Http\Requests\Admin\SearchOrderReportRequest;
use App\Http\Resources\Admin\OrderReportResource;
use App\Http\Resources\Admin\OrderReportsShortResource;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use App\Models\OrderReport;
use App\Models\OrderReportChange;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrderReportsController
 * @package App\Http\Controllers\Api\admin
 */
class OrderReportsController extends BaseApiController
{
    /**
     * OrderReportsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return OrderReportsShortResource::collection(OrderReport::all()->load(['order','user']));
    }

    /**
     * @param SearchOrderReportRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(SearchOrderReportRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'asc');

        $reports = OrderReport::orderBy($sortKey, $sortMethod)
            ->with(['order.orderProduct.product.brand','order.orderProduct.options','changes']);

        if(isset($request->id))
        {
            $reports = $reports->where('id', $request->id);
        }
        if(isset($request->order_id))
        {
            $reports = $reports->where('order_id', $request->order_id);
        }

        return OrderReportsShortResource::collection($reports->paginate(10));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $orderReport = OrderReport::findOrFail($id);
        $orderReport->image = $orderReport->image != null ? storage_path($orderReport->image) : null;
        return OrderReportResource::make($orderReport->load(['order.orderProduct.productOption','order.orderProduct.product','user', 'images']));
    }

    /**
     * @param OrderReportChangeStatusRequest $request
     * @param $id
     * @return mixed
     */
    public function changeStatus(OrderReportChangeStatusRequest $request, $id)
    {
        $orderReport = OrderReport::findOrFail($id);

        $orderReport->status = $request->status;
        $orderReport->admin_comment = $request->admin_comment;
        $orderReport->save();

        OrderReportChange::create([
            'order_report_id' => $orderReport->id,
            'admin_id' =>  $this->user->id,
            'new_status' => $request->status,
            'new_comment' => $request->admin_comment,
        ]);

        return $orderReport->load(['order.orderProduct.productOption','order.orderProduct.product.brand','changes']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatuses()
    {
        return $this->getResponse(OrderReportStatusesEnum::ALL_STATUSES);
    }
}
