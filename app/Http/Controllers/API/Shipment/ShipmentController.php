<?php

namespace App\Http\Controllers\API\Shipment;

use App\Http\Controllers\API\BaseApiController;
use App\Services\ShipmentService;

/**
 * Class ShipmentController
 * @package App\Http\Controllers\Api\Shipment
 */
class ShipmentController extends BaseApiController
{
    /**
     * @var ShipmentService
     */
    protected $shipmentService;

    /**
     * ShipmentController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->shipmentService = new ShipmentService();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDeliveryPoints()
    {
        $points = $this->shipmentService->getDeliveryPoints($this->user);
        return $this->getResponse($points);
    }
}
