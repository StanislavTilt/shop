<?php
namespace App\Channels;
use Illuminate\Notifications\Notification;
use App\Services\Sms\SmsRu;
use Illuminate\Support\Facades\Log;

class SmsRuChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param Notification $notification
     * @return void
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toSms($notifiable);
        (new SmsRu())->send($data['phone'], $data['message']);
    }
}
