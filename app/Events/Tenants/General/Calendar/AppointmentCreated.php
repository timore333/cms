<?php

namespace App\Events\Tenants\General\Calendar;

use App\Models\Tenants\General\Calendar;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AppointmentCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Calendar
     */
    public $appointment;

    /**
     * Create a new event instance.
     *
     * @param Calendar $appointment
     */
    public function __construct(Calendar $appointment)
    {
      $this->appointment = $appointment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
