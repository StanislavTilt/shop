<?php

namespace App\Channels;

use App\Services\Sms\StreamTelecom;
use Illuminate\Notifications\Notification;


class StreamTelecomChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toSms($notifiable);
        (new StreamTelecom())->send($data['phone'], $data['message']);
    }
}
