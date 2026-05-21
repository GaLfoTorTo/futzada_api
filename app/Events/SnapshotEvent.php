<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Game;

class SnapshotEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public readonly Game $game,
        public readonly string $uuid,
    ) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("event.{$this->uuid}"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'SnapshotEvent';
    }

    public function broadcastWith(): array
    {
        $stats = $this->game->stats?->stats ?? [];
        return [
            'type'    => 'snapshot',
            'game_id' => $this->game->id,
            'payload' => [
                // Tempo
                'status'           => $this->game->status,
                'minutes_elapsed'  => $stats['minutes_elapsed']  ?? 0,
                'remaining_elapsed'=> $this->resolveRemaining($stats),
                // Placar
                'team_a_score'     => $stats['team_a_score'] ?? 0,
                'team_b_score'     => $stats['team_b_score'] ?? 0,
                // Estatísticas
                'team_a_corners'   => $stats['team_a_corners'] ?? 0,
                'team_b_corners'   => $stats['team_b_corners'] ?? 0,
                'team_a_fouls'     => $stats['team_a_fouls'] ?? 0,
                'team_b_fouls'     => $stats['team_b_fouls'] ?? 0,
                'team_a_yellow'    => $stats['team_a_yellow_card'] ?? 0,
                'team_b_yellow'    => $stats['team_b_yellow_card'] ?? 0,
                'team_a_red'       => $stats['team_a_red_card'] ?? 0,
                'team_b_red'       => $stats['team_b_red_card'] ?? 0,
                'team_a_shots'     => $stats['team_a_shots'] ?? 0,
                'team_b_shots'     => $stats['team_b_shots'] ?? 0,
                'team_a_shots_goal'=> $stats['team_a_shots_goal'] ?? 0,
                'team_b_shots_goal'=> $stats['team_b_shots_goal'] ?? 0,
                'team_a_possession'=> $stats['team_a_possession'] ?? 0,
                'team_b_possession'=> $stats['team_b_possession'] ?? 0,
                'team_a_passes'    => $stats['team_a_passes'] ?? 0,
                'team_b_passes'    => $stats['team_b_passes'] ?? 0,
                'team_a_defense'   => $stats['team_a_defense'] ?? 0,
                'team_b_defense'   => $stats['team_b_defense'] ?? 0,
                'team_a_offside'   => $stats['team_a_offside'] ?? 0,
                'team_b_offside'   => $stats['team_b_offside'] ?? 0,
                // Eventos recentes da partida
                //'events' => $this->resolveEvents(),
            ],
        ];
    }
 
    /**
     * Nome da fila para não bloquear a fila principal.
     */
    public function broadcastQueue(): string
    {
        return 'broadcasting';
    }

    //FUNÇÃO PARA CALCULAR TEMPO DECORRIDO DA PARTIDA
    private function resolveRemaining(array $stats): int
    {
        $duration = $this->game->duration ?? 0;
        $elapsed  = $stats['minutes_elapsed'] ?? 0;
        return max(0, $duration - $elapsed);
    }
}
