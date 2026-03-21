<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameEventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'gameId'      => $this->game_id,
            'teamId'      => $this->team_id,
            'userId'      => $this->user_id,
            'actionId'    => $this->action_id,
            'minute'      => $this->minute,
            'title'       => $this->title,
            'description' => $this->description,
            'createdAt'   => $this->created_at?->toIso8601String(),
            'updatedAt'   => $this->updated_at?->toIso8601String(),
            'deletedAt'   => $this->deleted_at?->toIso8601String(),
        ];
    }
}