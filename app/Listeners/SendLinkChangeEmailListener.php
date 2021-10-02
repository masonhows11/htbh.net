<?php

namespace App\Listeners;

use App\Mail\ChangeUserEmailMail;
use App\Events\ChangeUserEmailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
     * @param ChangeUserEmailEvent $event
     * @return void
     */
    public function handle(ChangeUserEmailEvent $event)
    {
        //
        Mail::to($event->user->email)
            ->send(new ChangeUserEmailMail($event->user,$event->code));

    }
}
