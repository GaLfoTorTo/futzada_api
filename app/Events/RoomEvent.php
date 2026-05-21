<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoomEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(/* public readonly Event $event */) {}

    public function broadcastOn(): array
    {
        return [new Channel("event.event-123")];
    }

    public function broadcastAs(): string
    {
        return 'RoomEvent';
    }

    public function broadcastWith(): array
    {
        return [
            'type' => 'room',
            'status' => 'Aberta',//$this->event->room->status,
            'message' => 'Sala aberta',//$this->event->room->status === 'open' ? 'Sala aberta.' : 'Sala fechada.',
        ];
    }
}