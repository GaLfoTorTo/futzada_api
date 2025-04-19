<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id' => $this->id,
            'uuid' => $this->uuid,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'userName' => $this->user_name,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'bornDate' => $this->born_date,
            'visibility' => $this->visibility,
            'photo' => $this->photo,
            'token' => $this->token,
            'player' => $this->player,
            'manager' => $this->manager,
        ];
    }
}
