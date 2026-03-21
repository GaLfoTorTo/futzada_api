<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EscalationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'eventId'   => $this->event_id,
            'managerId' => $this->manager_id,
            'formation' => $this->formation,
            'starters'  => $this->starters ?? array_fill(0, 11, null),
            'reserves'  => $this->reserves ?? array_fill(0, 11, null),
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
        ];
    }
}