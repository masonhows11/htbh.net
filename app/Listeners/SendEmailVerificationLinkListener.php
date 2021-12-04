<?php

namespace App\Listeners;

use App\Events\RegisterUserEvent;
use App\Mail\EmailVerificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationLinkListener implements ShouldQueue
{
    // for immediately redirect user to another page after register in web use implements ShouldQueue
    // to send email verification email link in background
    // and use this command "  php artisan queue:work " to
    // run jobs in queue to execute jobs in queue in db and send email

    #public $connection = 'database';
    public $queue = 'RegisterUser'; // with specific queue name work
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
     * @param  RegisterUserEvent  $event
     * @return void
     */
    public function handle(RegisterUserEvent $event)
    {
        //
       Mail::to($event->user->email)->send(new EmailVerificationMail($event->user,$event->encrypted));
    }
   /* public function failed(RegisterUserEvent $event, $exception)
    {
        //
        abort(500,$exception);
    }*/
}
