<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\UserConfigResource;
use App\Resources\PlayerResource;
use App\Resources\ManagerResource;
use App\Resources\ParticipantResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'uuid'         => $this->uuid,
            'firstName'    => $this->first_name,
            'lastName'     => $this->last_name,
            'userName'     => $this->user_name,
            'email'        => $this->email,
            'bornDate'     => $this->born_date?->toDateString(),
            'phone'        => $this->phone,
            'photo'        => $this->photo_url,
            'privacy'      => $this->privacy,
            'config'       => UserConfigResource::make($this->whenLoaded('config')),
            'player'       => PlayerResource::make($this->whenLoaded('player')),
            'manager'      => ManagerResource::make($this->whenLoaded('manager')),
            'participants' => ParticipantResource::collection($this->whenLoaded('participants')),
            'createdAt'    => $this->created_at?->toIso8601String(),
            'updatedAt'    => $this->updated_at?->toIso8601String(),
            'deletedAt'    => $this->deleted_at?->toIso8601String(),
        ];
    }
}
