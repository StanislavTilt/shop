<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateNewCartListener
{
    /**
     * @param $event
     */
    public function handle(Registered $event)
    {
        $event->user->cart()->create();
    }
}
