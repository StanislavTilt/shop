<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class PushMessage
 * @package App\Events
 */
class PushMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    protected $tokens;

    /**
     * @var
     */
    protected $messageData;

    /**
     * @var
     */
    protected $data;

    /**
     * Create a new event instance.
     *
     * @param $messageData
     * @param $data
     * @param $user
     */
    public function __construct($messageData, $data, $tokens)
    {
        $this->tokens = $tokens;
        $this->messageData = $messageData;
        $this->data = $data;
    }

}
