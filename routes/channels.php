<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//CANAL DO EVENTO
Broadcast::channel('event.{uuid}', function (): bool 
{
    //RESGATAR EVENTO
    /* $event = Event::with('room')->where('uuid', $uuid)->first();
    
    //VERIFICAR SE EVENTO ESTA ONLINE
    if (!$event && $event->room->status) return false; */
    return true;
});