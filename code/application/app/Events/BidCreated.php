<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BidCreated
{

    /**
     * Create a new event instance.
     */
    public function __construct($id, $amount, $user)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->user = $user;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function data(): Channel
    {
        return new Channel('auctions.' . $this->id);
    }

    public function broadcastWith()
    {
        return [
            'amount' => $this->amount,
            'user' => $this->user,
            'created_at' => now()->format('Y-m-d H:i:s'),
            'user_id' => $this->user->id,

        ];
    }

    public function broadcastAs()
    {
        return 'bid.created';
    }


}
