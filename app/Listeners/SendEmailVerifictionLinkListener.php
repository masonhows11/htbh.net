<?php

namespace App\Listeners;

use App\Events\RegisterUserEvent;
use App\Mail\EmailVerification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerifictionLinkListener //implements ShouldQueue
{

    use InteractsWithQueue;

    public $connection = 'database';
    public $queue = 'RegisterUserEmailVerifyListeners';
    public $delay = 10;
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
       Mail::to($event->user->email)->send(new EmailVerification($event->user));
    }
   /* public function failed(RegisterUserEvent $event, $exception)
    {
        //
        abort(500,$exception);
    }*/
}
