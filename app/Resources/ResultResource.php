<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\TeamResource;

class ResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'gameId'      => $this->game_id,
            'teamA'       => $this->whenLoaded('teamA') ? TeamResource::make($this->teamA) : null,
            'teamB'       => $this->whenLoaded('teamB') ? TeamResource::make($this->teamB) : null,
            'teamAScore'  => $this->team_a_score,
            'teamBScore'  => $this->team_b_score,
            'duration'    => $this->duration,
            'createdAt'   => $this->created_at?->toIso8601String(),
            'updatedAt'   => $this->updated_at?->toIso8601String(),
            'deletedAt'   => $this->deleted_at?->toIso8601String(),
        ];
    }
}