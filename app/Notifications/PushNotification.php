<?php

namespace App\Notifications;

use App\Channels\FirebasePush;
use App\Notifications\Messages\PushMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PushNotification extends Notification
{
    use Queueable;

    protected $tokens;

    protected $data;

    protected $messageData;

    /**
     * Create a new notification instance.
     *
     * @param $messageData
     * @param $data
     * @param $tokens
     */
    public function __construct($messageData, $data, $tokens)
    {
        $this->messageData = $messageData;
        $this->data = $data;
        $this->tokens = $tokens;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [FirebasePush::class];
    }

    /**
     *
     * @param  mixed  $notifiable
     * @return PushMessage
     */
    public function toFirebase($notifiable): PushMessage
    {
        return (new PushMessage())
                    ->setRecipient($this->tokens)
                    ->setContent($this->messageData)
                    ->setData($this->data);
    }

}
