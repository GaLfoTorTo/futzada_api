<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameConfigResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'eventId'       => $this->event_id,
            'refereerId'    => $this->referee_id,
            'category'      => $this->category,
            'duration'      => $this->duration,
            'playersPerTeam'=> $this->players_per_team,
            'points'        => $this->points,
            'config'        => $this->config ?? [],
            'createdAt'     => $this->created_at?->toIso8601String(),
            'updatedAt'     => $this->updated_at?->toIso8601String(),
            'deletedAt'     => $this->deleted_at?->toIso8601String(),
        ];
    }
}