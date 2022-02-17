<?php

namespace App\Listeners;

use App\Enums\MessageTemplateKeysEnum;
use App\Models\MessageTemplate;
use App\Notifications\VerifyPhone;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRegisterValidationMessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $messageTemplate = MessageTemplate::where('key', MessageTemplateKeysEnum::REGISTER)
            ->first();
        $message = $messageTemplate->content.$event->code;
        $user = $event->user;
        $user->notify(new VerifyPhone($message));
    }
}
