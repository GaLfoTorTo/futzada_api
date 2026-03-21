<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\User;
use App\Models\Participant;

class EventController extends Controller
{
    public function userEvents(Request $request){
        $id = $request->input("user_id");
        $events = Event::where('user_id', $id)->get();
        return response()->json(['eventos' => $events], 200);
    }

    public function events(){
        
    }

    public function create(Request $request){
        //INICIALIZAR TRANSAÇÃO NO DB
        DB::beginTransaction();
        //TENTAR SALVAR PELADA
        try {
            //VERIFICAR SE DADOS RECEBIDOS NÃO ESTÃO VAZIOS
            if(!empty($request->all())){
                //DEFINIR DADOS BASICOS DA PELADA
                $data = [
                    'uuid' => (string) Str::uuid(),
                    'title'=> $request['title'],
                    'bio'=> $request['bio'],
                    'address'=> $request['address'],
                    'number'=> $request['number'],
                    'city'=> $request['city'],
                    'state'=> $request['state'],
                    'complement'=> $request['complement'],
                    'country'=> $request['country'],
                    'zip_code'=> $request['zip_code'],
                    'days_week'=> json_encode($request['days_week']),
                    'date'=> date('Y-m-d', strtotime($request['date'])),
                    'time'=> date('H:i', strtotime($request['time'])),
                    'category'=> $request['category'],
                    'qtd_players'=> $request['qtd_players'],
                    'visibility'=> $request['visibility'],
                    'allow_collaborators'=> $request['allow_collaborators'],
                ];
                //VERIFICAR SE FOI RECEBIDO FOTO DO USUÁRIO
                if($request->hasFile('photo')){
                    //RESGATAR RESQUEST PARA FUNÇÃO DE UPLOAD
                    $dataFile['request'] = $request;
                    //DEFINIR PASTA DE ARQUIVOS DO USUARIO
                    $dataFile['pasta'] = 'events/'.$data['uuid'];
                    //SALVAR FOTO DE USUARIO
                    $data['photo'] = upload($dataFile);
                }
                //SALVAR EVENTO
                $event = Event::create($data);
                //SALVAR PARTICIPANTES
                $this->participantsEvent($request->participantes, $event->id);
                //CONSOLIDAR OPERAÇÃO
                DB::commit();
                return response()->json(['message' => 'Event registrado com sucesso!'], 200);
            }else{
                return response()->json(['message' => 'Os dados da Event estão vazios!'], 400);
            }
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('registro')->error("[Erro de Registro][User][Registro]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            return response()->json(['message' => 'Houve um erro ao registrar o Usuário.'], 400);
        }
    }

    private function participantsEvent($request, $event_id){
        //VERIFICAR SE FOI RECEBIDO PARTICPANTES
        if(!empty($request->participantes)){
            //DECODIFICAR PARTICIPANTES
            $participantes = json_decode($request->participantes);
            //VERIFICAR SE O USUÁRIO É UM PARTICIPANTE
            foreach($participantes as $key => $item){
                //VERIFICAR SE O USUÁRIO É UM PARTICIPANTE
                if(isset($item['user_id']) && !empty($item['user_id'])){
                    //SALVAR PARTICIPANTE
                    Participant::create([
                        'event_id' => $event_id,
                        'user_id' => $item['user_id'],
                        'role' => $request->roles,
                        'permissions' => $request->permissions,
                        'status' => 'Avaliable',
                        'joinedt_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }

        }
    }
}
