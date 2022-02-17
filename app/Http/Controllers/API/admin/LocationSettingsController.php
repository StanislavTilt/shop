<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\UpdateConversionCommissionRequest;
use App\Http\Requests\Admin\UpdateLocationSettingsRequest;
use App\Models\Location;
use App\Models\LocationSetting;
use App\Models\OtherServerSetting;

/**
 * Class LocationSettingsController
 * @package App\Http\Controllers\Api\admin
 */
class LocationSettingsController extends BaseApiController
{
    /**
     * @return LocationSetting[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return LocationSetting::all()->load('location');
    }

    /**
     * @return Location[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getLocations()
    {
        return Location::all();
    }

    /**
     * @param LocationSetting $locationSetting
     * @return LocationSetting
     */
    public function show(LocationSetting $locationSetting)
    {
        return $locationSetting->load('location');
    }

    /**
     * @param UpdateLocationSettingsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateLocationSettingsRequest $request)
    {
        $locationSettings = LocationSetting::findOrfail($request->location_id);

        $requestData = $request->only([
            'kilogram_price',
            'allowance'
        ]);

        $locationSettings->update($requestData);

        return $this->getResponse($locationSettings->toArray());
    }
}

