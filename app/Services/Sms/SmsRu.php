<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

/**
 * Class SmsRu
 * @package App\Services\Sms
 */
class SmsRu
{
    /**
     * @param $number
     * @param $message
     *
     * @throws RequestException
     */
    public function send($number, $message): void
    {
        $appId = config('sms.drivers.sms_ru.app_id');
        $url = config('sms.drivers.sms_ru.url');

        Http::get($url, [
            'api_id' => $appId,
            'to' => '+'.trim($number, '+'),
            'text' => $message
        ])->throw();
    }
}
