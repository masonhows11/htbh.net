<?php

namespace App\Listeners;

use App\Events\RegisterUserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailVerifictionLink
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
     * @param  RegisterUserEvent  $event
     * @return void
     */
    public function handle(RegisterUserEvent $event)
    {
        //
    }
}
