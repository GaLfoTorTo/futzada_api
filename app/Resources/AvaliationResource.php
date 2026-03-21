<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvaliationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'userId'     => $this->user_id,
            'eventId'    => $this->event_id,
            'avaliation' => $this->avaliation ?? 0.0,
            'comment'    => $this->comment,
            'createdAt'  => $this->created_at?->toIso8601String(),
            'updatedAt'  => $this->updated_at?->toIso8601String(),
            'deletedAt'  => $this->deleted_at?->toIso8601String(),
        ];
    }
}