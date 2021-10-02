<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeUserEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $encrypted;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $code
     */
    public function __construct(User $user,$code)
    {
        //
        $this->user =  $user;
        $this->encrypted = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('لینک تایید تغییر آدرس ایمیل.')
            ->markdown('emails.email_change_email')
            ->with([
                'name'=>$this->user->name,
                'code'=>$this->encrypted,
                'id'=>$this->user->id,
            ]);
    }
}
