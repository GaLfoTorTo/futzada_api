<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\AddressResource;
use App\Resources\GameConfigResource;
use App\Resources\AvaliationResource;
use App\Resources\UserResource;
use App\Resources\RuleResource;
use App\Resources\NewsResource;
use App\Resources\GameResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'uuid'          => $this->uuid,
            'title'         => $this->title,
            'bio'           => $this->bio,
            'date'          => $this->date ?? [],
            'startTime'     => $this->start_time,
            'endTime'       => $this->end_time,
            'modality'      => $this->modality,
            'collaborators' => $this->collaborators,
            'photo'         => $this->photo_url,
            'privacy'       => $this->privacy,
            'address'       => AddressResource::make($this->whenLoaded('address')),
            'gameConfig'    => GameConfigResource::make($this->whenLoaded('gameConfig')),
            'avaliations'   => AvaliationResource::collection($this->whenLoaded('avaliations')),
            'participants'  => UserResource::collection($this->whenLoaded('participants')),
            'rules'         => RuleResource::collection($this->whenLoaded('rules')),
            'news'          => NewsResource::collection($this->whenLoaded('news')),
            'games'         => GameResource::collection($this->whenLoaded('games')),
            'createdAt'     => $this->created_at?->toIso8601String(),
            'updatedAt'     => $this->updated_at?->toIso8601String(),
            'deletedAt'     => $this->deleted_at?->toIso8601String(),
        ];
    }
}