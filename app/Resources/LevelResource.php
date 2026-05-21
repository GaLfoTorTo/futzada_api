<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'number'        => $this->number,
            'tier'          => $this->tier,
            'points'        => $this->pivot?->points ?? 0,
            'points_min'    => $this->points_min ?? 0,
            'points_max'    => $this->points_max ?? 0,
            'image'         => $this->image,
            'color'         => $this->color,
            'createdAt'     => $this->created_at?->toIso8601String(),
            'updatedAt'     => $this->updated_at?->toIso8601String(),
            'deletedAt'     => $this->deleted_at?->toIso8601String(),
        ];
    }
}