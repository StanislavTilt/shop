<?php

namespace App\Notifications;

use App\Services\Sms\StreamTelecom;
use Illuminate\Notifications\Notification;
use App\Channels\SmsRuChannel;
use Illuminate\Support\Facades\Log;

/**
 * Class VerifyPhone
 * @package App\Notifications
 */
class VerifyPhone extends Notification
{
    public $content;

    /**
     * VerifyPhone constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->content = $message;
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable): array
    {
        return [StreamTelecom::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toSms($notifiable): array
    {
        return [
            'phone' => $notifiable->phone,
            'message' => $this->content,
        ];
    }
}
