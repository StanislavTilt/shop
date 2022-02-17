<?php

namespace App\Providers;

use App\Events\CreatedRestoreRequestEvent;
use App\Events\PhoneVerification;
use App\Events\PushMessage;
use App\Listeners\CreateNewCartListener;
use App\Listeners\PhoneVerificationListener;
use App\Listeners\SendRegisterValidationMessageListener;
use App\Listeners\SendRestoreValidationMessageListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\SendSmsVerificationNotificationListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendRegisterValidationMessageListener::class,
            CreateNewCartListener::class
        ],
        PhoneVerification::class => [
            PhoneVerificationListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
