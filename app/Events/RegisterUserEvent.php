<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterUserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $encrypted;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param $encrypted
     */
    public function __construct(User $user,$encrypted)
    {
        //
        $this->user = $user;
        $this->encrypted= $encrypted;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
   /* public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }*/
}
