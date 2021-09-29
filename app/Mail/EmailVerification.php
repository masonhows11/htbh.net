<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $encrypted;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $encrypted
     */
    public function __construct(User $user,$encrypted)
    {
        //
        $this->user = $user;
        $this->encrypted = $encrypted;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('لینک فعال سازی حساب کاربری')->markdown('emails.email_verification')
            ->with([
                'name'=>$this->user->name,
                'code'=> $this->encrypted,
                'id' => $this->user->id,
            ]);
    }
}
