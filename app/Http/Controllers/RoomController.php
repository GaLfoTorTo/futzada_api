<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRoomService;

class RoomController extends Controller
{    
    public function __construct(private readonly EventRoomService $roomService) {}

    /**
     * FUNÇÃO DE ENTRADA NA SALA DO EVENTO
     * Route: POST /api/events/room/join;
    */
    public function join(Request $request): JsonResponse
    {
        $this->roomService->join($request->uuid);
        return response()->json(['message' => 'Bem-Vindo.'], 200);
    }
    
    /**
     * FUNÇÃO DE SAÍDA DE SALA DO EVENTO
     * Route: POST /api/events/room/exit;
    */
    public function exit(Request $request): JsonResponse
    {
        $this->roomService->exit($request->uuid);
        return response()->json(['message' => 'Até a próxima.'], 200);
    }

    /**
     * FUNÇÃO DE ABERTURA/FECHAMENTO DE SALA DO EVENTO
     * Route: POST /api/events/room/stream;
    */
    public function stream(Request $request): JsonResponse
    {
        //DISPARAR SERVIÇO DE ABERTURA/FECHAMENTO DE SALA
        $status = $this->roomService->stream($request->uuid, $request->status);
        //RESPOSTA DE SUCESSO/ERRO
        $message = $status ? 'aberta': 'fechada';
        return response()->json(['message' => "Sala $message com sucesso."], 200);
    }
}
