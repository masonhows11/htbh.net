<?php

namespace App\Listeners;

use App\Events\ResetPassUserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendResetPassLinkListener
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
     * @param  ResetPassUserEvent  $event
     * @return void
     */
    public function handle(ResetPassUserEvent $event)
    {
        //
    }
}
