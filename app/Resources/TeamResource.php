<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\PlayerResource;

class TeamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'gameId'    => $this->game_id,
            'uuid'      => $this->uuid,
            'name'      => $this->name,
            'emblem'    => $this->emblem_url,
            'players'   => $this->whenLoaded('players') ? PlayerResource::collection($this->players) : [],
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
            'deletedAt' => $this->deleted_at?->toIso8601String(),
        ];
    }
}