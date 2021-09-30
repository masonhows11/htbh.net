<?php

namespace App\Providers;

use App\Events\RegisterUserEvent;
use App\Events\ResetPassUserEvent;
use App\Listeners\SendEmailVerifictionLinkListener;
use App\Listeners\SendResetPassLinkListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RegisterUserEvent::class =>[
            SendEmailVerifictionLinkListener::class,
        ],
        ResetPassUserEvent::class =>[
            SendResetPassLinkListener::class,
        ]

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
