<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\CreateDeliveryCostForecastRequest;
use App\Http\Requests\Admin\UpdateDeliveryCostForecastRequest;
use App\Http\Resources\Admin\DeliveryCostForecastResource;
use App\Models\DeliveryCostForecast;

/**
 * Class DeliveryCostForecastController
 * @package App\Http\Controllers\API\admin
 */
class DeliveryCostForecastController extends BaseApiController
{
    /**
     * DeliveryCostForecastController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param CreateDeliveryCostForecastRequest $request
     * @return DeliveryCostForecastResource
     */
    public function create(CreateDeliveryCostForecastRequest $request)
    {
        $requestData = $request->validated();
        $object = DeliveryCostForecast::create($requestData);

        return DeliveryCostForecastResource::make($object);
    }

    /**
     *
     */
    public function index()
    {
        $objects = DeliveryCostForecast::all();
        return DeliveryCostForecastResource::collection($objects);
    }

    /**
     * @param $object_id
     * @return DeliveryCostForecastResource
     */
    public function show($object_id)
    {
        $object = DeliveryCostForecast::findOrFail($object_id);
        return DeliveryCostForecastResource::make($object);
    }

    /**
     * @param UpdateDeliveryCostForecastRequest $request
     * @param $object_id
     * @return DeliveryCostForecastResource
     */
    public function update(UpdateDeliveryCostForecastRequest $request, $object_id)
    {
        $requestData = $request->validated();
        $object = DeliveryCostForecast::findOrFail($object_id);

        $object->update($requestData);
        return DeliveryCostForecastResource::make($object);
    }

    /**
     * @param $object_id
     */
    public function delete($object_id)
    {
        $object = DeliveryCostForecast::findOrFail($object_id);
        $object->delete();
    }
}
