<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Event;
use App\Models\Room;
use App\Events\RoomEvent;

class RoomService
{
    public function __construct() {}

    //FUNÇÃO PARA ABRIR ENTRAR NO EVENTO
    public function join(string $uuid): Room
    {
        //DISPARAR EVENTO DE ENTRADA DE PARTICIPANTE NA SALA
    }

    //FUNÇÃO PARA ABRIR SALA DO EVENTO
    public function exit(string $uuid): Room
    {
        //DISPARAR EVENTO DE SAIDA DE PARTICIPANTE NA SALA
    }

    //FUNÇÃO PARA ABRIR SALA DO EVENTO
    public function strem(string $uuid, string $stauts): bool
    {
        try {
            //BUSCAR EVENTO
            $event = Event::with('room')->where('uuid', $uuid)->firstOrFail();
            //ATUALIZAR STATUS DA SALA
            $event->room->update([
                'event_id'  => $event->id,
                'status'    => $status,
                'opened_at' => now(),
            ]);
            //DISPARAR EVENTO DE FECHAMENTO DE SALA
            broadcast(new RoomEvent($event));
            //DISPARAR NOTIFICAÇÃO DE ABERTURA DE SALA
            $this->notify($event);
            return true;
        } catch (\Exception $e) {
            //REGISTAR ERRO NO LOG
            Log::error("[Erro ao iniciar a sala][Evento][uuid=$uuid]", ['error' => $e->getTraceAsString()]);
            return false;
        }
    }

    //FUNÇÃO PARA NOTIFICAÇÃO DE ABERTURA DE SALA
    private function notify(Event $event): void
    {
        //DEFINIR TOPICO DO CANAL DE EVENTO
        $topic = 'event_' . str_replace('-', '_', $event->uuid);
        //DISPARAR NOTIFICAÇÃO
        $this->fcm->sendToTopic(
            topic: $topic,
            title: "🟢 {$event->title} — Dia de Jogo!",
            body:  "Pelada ta no ar! Entre na sala para acompanhar tudo ao vivo.",
            data:  [
                'type'       => 'room_opened',
                'event_uuid' => $event->uuid,
                'event_id'   => (string) $event->id,
            ],
        );
    }
}