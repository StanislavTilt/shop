<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use CodersStudio\SmsRu\Channels\SmsRuChannel;

/**
 * Class ResetPassword
 * @package App\Notifications
 */
class ResetPassword extends Notification
{
    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable): array
    {
        return [SmsRuChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toSms($notifiable): array
    {
        return $this->toArray($notifiable);
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'phone' => $notifiable->phone,
            'message' => __('Password recovery code: :code', ['code' => $notifiable->phone_verification_code])
        ];
    }
}
