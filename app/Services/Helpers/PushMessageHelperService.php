<?php
/**
 * Created by PhpStorm.
 * User: stasi
 * Date: 16.02.2022
 * Time: 18:02
 */

namespace App\Services\Helpers;


use App\Enums\OrdersStatusesValueEnum;
use App\Events\PushMessage;
use App\Models\Order;
use App\Models\PushMessageTemplate;
use App\Services\Helpers\FirebaseService;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PushMessageHelperService
 * @package App\Services\Helpers
 */
class PushMessageHelperService
{
    /**
     * @param $tokens
     * @param $pushTypeKey
     * @param $object
     */
    public function sendPush($tokens, $pushTypeKey, $object)
    {
        $fireBaseService = new FirebaseService();
        $messageData = $this->formMessageData($pushTypeKey, $object);
        $data = [
            'type' => $pushTypeKey,
            'id' => $object->id,
        ];
        $fireBaseService->sendNotification($tokens, $messageData, $data);
    }

    /**
     * @param $typeKey
     * @return array
     */
    protected function formMessageData($typeKey, $object)
    {
        $messageTemplate = PushMessageTemplate::whereHas('type', function (Builder $query) use ($typeKey){
            $query->where('key', $typeKey);
        })->firstOrFail();

        $body = $messageTemplate->body;

        if(isset($messageTemplate->replaceable_keys))
        {
            foreach ($messageTemplate->replaceable_keys as $key)
            {
                $replace = $object->{$key};
                $body = str_replace($key, $replace, $body);
            }
        }

        return [
            'title' => $messageTemplate->title,
            'body' => $body,
        ];
    }
}
