<?php

namespace App\Managers;

use App\Models\User;

class UserManager 
{
    //BUSCAR ID DO USER
    public function getUserId() {
        return auth()->user()->id;
    }
    //BUSCAR USER
    public function getUser(): User {
        return auth()->user()->User;
    }
}