<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'playerId'  => $this->player_id,
            'eventId'   => $this->event_id,
            'userId'    => $this->user_id,
            'role'      => $this->role,
            'points'    => $this->points ?? 0.0,
            'avarage'   => $this->avarage ?? 0.0,
            'valuation' => $this->valuation ?? 0.0,
            'price'     => $this->price ?? 0.0,
            'games'     => $this->games ?? 0,
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
            'deletedAt' => $this->deleted_at?->toIso8601String(),
        ];
    }
}