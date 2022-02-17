<?php

namespace App\Http\Controllers\API\admin;

use App\Enums\OrderDeliveryStatusesEnum;
use App\Enums\OrdersStatusesValueEnum;
use App\Enums\PushMessageTemplateTypesEnum;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\DeleteProductFromOrderRequest;
use App\Http\Requests\Admin\OrderChangeStatusRequest;
use App\Http\Requests\Admin\SearchOrdersRequest;
use App\Http\Resources\Admin\OrderResource;
use App\Http\Resources\Admin\ShortOrderResource;
use App\Models\Order;
use App\Models\OrderChange;
use App\Models\OrderProduct;
use App\Models\PushMessageTemplate;
use App\Services\Helpers\OrderHelperService;
use App\Services\Helpers\PushMessageHelperService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\ArrayToXml\ArrayToXml;

/**
 * Class OrderController
 * @package App\Http\Controllers\Api\Admin
 */
class OrderController extends BaseApiController
{
    /**
     * @var OrderHelperService
     */
    protected $orderHelper;
    protected $pushMessageHelper;

    /**
     * OrderController constructor.
     * @param OrderHelperService $orderHelperService
     * @param PushMessageHelperService $pushMessageHelper
     */
    public function __construct(OrderHelperService $orderHelperService, PushMessageHelperService $pushMessageHelper)
    {
        parent::__construct();
        $this->orderHelper = $orderHelperService;
        $this->pushMessageHelper = $pushMessageHelper;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $orders = Order::with(['orderProduct', 'user'])
            ->get()
            ->each(function ($order) {
                $order->summary_price = $this->orderHelper->countSummaryPrice($order);
            });
        return ShortOrderResource::collection($orders);
    }

    /**
     * @param $id
     * @return OrderResource
     */
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->with(['orderProduct.product.brand', 'orderProduct.product.attributes', 'user', 'orderChanges','orderProduct.productOption.color'])
            ->first();
        $costs = $order->orderProduct->pluck('price')->toArray();
        $order->summary_price = array_sum($costs);
        return OrderResource::make($order);
    }

    /**
     * @param DeleteProductFromOrderRequest $request
     */
    public function deleteProductFromOrder(DeleteProductFromOrderRequest $request)
    {
        $order = Order::findOrFail($request->order_id);
        $orderProduct = OrderProduct::where('order_id', $order->id)
            ->where('product_id', $request->product_id)
            ->firstOrFail();
        $orderProduct->delete();
        OrderChange::create([
            'order_id' => $order->id,
            'deleted_product_id' => $request->product_id,
            'admin_changed_id' => $this->user->id,
        ]);
    }

    /**
     * @param SearchOrdersRequest $request
     * @return mixed
     */
    public function searchOrders(SearchOrdersRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'desc');

        $orders = Order::orderBy($sortKey, $sortMethod)
            ->with(['orderProduct.product','orderProduct.productOption.color']);

        if(isset($request->id))
        {
            $orders = $orders->where('id', $request->id);
        }
        if(isset($request->user_id))
        {
            $orders = $orders->where('user_id', $request->user_id);
        }
        if(isset($request->created_at))
        {
            $orders = $orders->where('created_at', 'like', '%'.$request->created_at.'%');
        }
        if(isset($request->status))
        {
            $orders = $orders->where('status', $request->status);
        }

        return OrderResource::collection($orders->paginate(10));
    }

    /**
     * @param OrderChangeStatusRequest $request
     */
    public function update(OrderChangeStatusRequest $request)
    {
        $order = Order::where('id',$request->order_id)
            ->with('user')
            ->firstOrFail();
        $updateData = $request->only([
            'status',
            'delivery_date',
            'delivery_status',
        ]);
        $order->update($updateData);

        $order->status = OrderHelperService::getStatusValue($order->delivery_status);

        $this->pushMessageHelper
            ->sendPush(array($order->user->device_key), PushMessageTemplateTypesEnum::ORDER_CHANGE_STATUS,$order);

        OrderChange::create([
            'order_id' => $order->id,
            'new_status' => $request->status,
            'system_change' => false,
            'admin_changed_id' => $this->user->id,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getInfoInFile($id)
    {
        $order = Order::where('id', $id)
            ->with(['orderProduct.product.brand', 'orderProduct.productOption.color', 'user', 'orderChanges'])
            ->first()->toArray();
        $result = ArrayToXml::convert($order);
        $filename = 'export_order_'.$order['id'].'_'.time().'.xml';
        File::put(public_path('/export_orders/'.$filename), $result);

        return Response::download(public_path('/export_orders/'.$filename));
    }

    /**
     * @return array
     */
    public function getOrderStatuses()
    {
        return [
            'delivery_statuses' => OrderDeliveryStatusesEnum::all(),
            'order_statuses' => OrdersStatusesValueEnum::keysValue()
        ];
    }
}
