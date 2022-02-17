<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\UpdateConversionCommissionRequest;
use App\Models\OtherServerSetting;

/**
 * Class ServerSettingsController
 * @package App\Http\Controllers\Api\admin
 */
class ServerSettingsController extends BaseApiController
{
    /**
     * @return OtherServerSetting[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllSettings()
    {
        return OtherServerSetting::all();
    }

    /**
     * @param UpdateConversionCommissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateConversionCommission(UpdateConversionCommissionRequest $request)
    {
        $setting = OtherServerSetting::where('key', OtherServerSetting::CURRENCY_CONVERSION_COMMISSION)
            ->firstOrFail();
        $setting->update(['value' => $request->commission]);
        return $this->getSuccessResponse(200);
    }
}
