<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PhoneVerification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $code;
    public $messageType;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $code
     * @param $messageType
     */
    public function __construct($user, $code, $messageType)
    {
        $this->user = $user;
        $this->code = $code;
        $this->messageType = $messageType;
    }

}
