<?php

namespace App\Channels;


use App\Services\FirebaseService;
use Illuminate\Notifications\Notification;

class FirebasePush
{
    /**
     * @param $notifiable
     * @param Notification $notification

     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFirebase($notifiable);

        (new FirebaseService())->sendNotification(
            $message->getRecipient(),
            $message->getContent(),
            $message->getData()
        );
    }
}
