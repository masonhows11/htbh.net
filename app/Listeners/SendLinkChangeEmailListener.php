<?php

namespace App\Listeners;

use App\Mail\ChangeUserEmailMail;
use App\Events\ChangeUserEmailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLinkChangeEmailListener implements ShouldQueue
{
    // for immediately redirect user to another page after register in web use implements ShouldQueue
    // to send email verification email link in background
    // and use this command "  php artisan queue:work " to
    // run jobs in queue to execute jobs in queue in db and send email

    public $queue = 'ChangeUserEmail';
    public $delay = 1;
    public $tries = 5;
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
            ->send(new ChangeUserEmailMail($event->user,$event->encrypted));

    }
}
