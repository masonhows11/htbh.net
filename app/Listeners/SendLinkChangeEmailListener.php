<?php

namespace App\Listeners;

use App\Events\ChangeUserEmailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLinkChangeEmailListener
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
     * @param  ChangeUserEmailEvent  $event
     * @return void
     */
    public function handle(ChangeUserEmailEvent $event)
    {
        //
    }
}
