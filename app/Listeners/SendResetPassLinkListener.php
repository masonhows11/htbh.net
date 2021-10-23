<?php

namespace App\Listeners;

use App\Events\ResetPassUserEvent;
use App\Mail\ResetUserPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
        Mail::to($event->user->email)->send(new ResetUserPasswordMail($event->user,$event->token));
    }
}
