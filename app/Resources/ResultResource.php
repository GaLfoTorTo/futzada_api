<?php

namespace App\Http\Resources;

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
            'teamA'       => TeamResource::make($this->whenLoaded('teamA')),
            'teamB'       => TeamResource::make($this->whenLoaded('teamB')),
            'teamAScore'  => $this->team_a_score,
            'teamBScore'  => $this->team_b_score,
            'duration'    => $this->duration,
            'createdAt'   => $this->created_at?->toIso8601String(),
            'updatedAt'   => $this->updated_at?->toIso8601String(),
            'deletedAt'   => $this->deleted_at?->toIso8601String(),
        ];
    }
}