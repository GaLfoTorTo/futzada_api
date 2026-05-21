<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\ResultResource;
use App\Resources\TeamResource;

class GameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'number'     => $this->number,
            'eventId'    => $this->event_id,
            'refereeId'  => $this->referee_id,
            'duration'   => $this->duration,
            'startTime'  => $this->start_time,
            'endTime'    => $this->end_time,
            'status'     => $this->status,
            'result'     => $this->whenLoaded('result') ? ResultResource::make($this->result) : null,
            'teams'      => $this->whenLoaded('teams') ? TeamResource::collection($this->teams) : [],
            'createdAt'  => $this->created_at?->toIso8601String(),
            'updatedAt'  => $this->updated_at?->toIso8601String(),
            'deletedAt'  => $this->deleted_at?->toIso8601String(),
        ];
    }
}