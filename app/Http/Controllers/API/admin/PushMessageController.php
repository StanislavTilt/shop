<?php

namespace App\Http\Controllers\Api\admin;

use App\Enums\PushMessageTemplateTypesEnum;
use App\Events\PushMessage;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SendPushMessageRequest;
use App\Models\PushMessageType;
use App\Models\User;
use App\Services\Helpers\FirebaseService;
use Illuminate\Http\Request;

/**
 * Class PushMessageController
 * @package App\Http\Controllers\Api\admin
 */
class PushMessageController extends BaseApiController
{
    /**
     * @var FirebaseService
     */
    protected $fireBaseService;

    /**
     * PushMessageController constructor.
     * @param FirebaseService $fireBaseService
     */
    public function __construct(FirebaseService $fireBaseService)
    {
        parent::__construct();
        $this->fireBaseService = $fireBaseService;
    }

    /**
     * @return PushMessageType[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getTypes()
    {
        $keys = PushMessageTemplateTypesEnum::availableToSendPush();
        return PushMessageType::whereIn('key', $keys)->get();
    }

    /**
     * @param SendPushMessageRequest $request
     */
    public function sendPush(SendPushMessageRequest $request)
    {
        $fcmTokens = User::where('device_key', '<>', null)
            ->get()
            ->pluck('device_key')->all();
        $messageData = $request->only([
            'title',
            'body',
        ]);
        $data = [
            'type' => $request->type_key
        ];
        if(isset($request->object_id))
        {
            $data['id'] = $request->object_id;
        }
        $this->fireBaseService->sendNotification($fcmTokens, $messageData, $data);
    }
}
