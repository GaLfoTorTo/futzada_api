<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Action;
use App\Models\GameEvent;

class ActionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly GameEvent $gameEvent,
        public readonly string $eventUuid,
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("event.{$this->eventUuid}"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'GameActionEvent';
    }

    /**
     * Payload no formato duplo (snake_case + camelCase) para o
     * GameEventModel.fromMap() aceitar sem adaptação.
     */
    public function broadcastWith(): array
    {
        $e = $this->gameEvent;

        return [
            'type'    => 'action',
            'game_id' => $e->game_id,
            'payload' => [
                // Ambos os formatos — fromMap() aceita os dois
                'id'          => $e->id,
                'gameId'      => $e->game_id,
                'teamId'      => $e->team_id,
                'userId'      => $e->user_id,
                'minute'      => $e->minute,
                'title'       => $e->title,
                'description' => $e->description,
                'type'        => $e->type,      // GameEvent enum: goal, yellowCard...
                'action'      => $e->type,      // alias lido pelo _applyAction no mixin
                'team'        => $e->team_id === $e->game->team_a_id ? 'A' : 'B',
                'createdAt'   => $e->created_at?->toIso8601String(),
            ],
        ];
    }

    public function broadcastQueue(): string
    {
        return 'broadcasting';
    }
}