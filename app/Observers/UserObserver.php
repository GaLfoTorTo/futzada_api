<?php

namespace App\Observers;

use Illuminate\DataBase\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        // GERAR UUID AUTOMATICAMENTE CASO ESTEJA VAZIO
        if (empty($user->uuid)) {
            $user->uuid = (string) Str::uuid();
        }
    }
    /**
     * Handle the User "created" event.
     */
    public function created(User $User): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $User): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $User): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $User): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $User): void
    {
        //
    }
}
