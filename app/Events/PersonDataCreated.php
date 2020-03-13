<?php

namespace App\Events;

use App\PersonData;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PersonDataCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    public $person_data;

    /**
     * Create a new event instance.
     */
    public function __construct(PersonData $person_data)
    {
        $this->person_data = $person_data;
    }

    /*
     * Get the channels the event should broadcast on.
     *
     * @return array|\Illuminate\Broadcasting\Channel
     */
    /* public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    } */
}
