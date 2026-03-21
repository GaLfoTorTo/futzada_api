<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EconomyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'managerId'   => $this->manager_id,
            'eventId'     => $this->event_id,
            'patrimony'   => $this->patrimony ?? 0.0,
            'price'       => $this->price ?? 0.0,
            'valuation'   => $this->valuation ?? 0.0,
            'points'      => $this->points ?? 0.0,
            'totalPoints' => $this->total_points ?? 0.0,
            'createdAt'   => $this->created_at?->toIso8601String(),
            'updatedAt'   => $this->updated_at?->toIso8601String(),
        ];
    }
}