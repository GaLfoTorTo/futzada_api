<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Player;
use App\Models\PlayerPosition;
use App\Models\Manager;
use App\Models\Position;

class UserController extends Controller
{
    public function create(Request $request){
        //INICIALIZAR TRANSAÇÃO NO DB
        DB::beginTransaction();
        //TENTAR SALVAR O USUÁRIO
        try {
            //VERIFICAR SE DADOS RECEBIDOS NÃO ESTÃO VAZIOS
            if(!empty($request->all())){
                //DEFINIR DADOS BASICOS DO USUARIO
                $data = [
                    'uuid' => (string) Str::uuid(),
                    'first_name'=> $request['firstName'],
                    'last_name'=> $request['lastName'],
                    'user_name'=> $request['userName'],
                    'email'=> $request['email'],
                    'password'=> bcrypt($request['password']),
                    'born_date'=> !empty($request['bornDate']) ? date('Y-m-d', strtotime($request['bornDate'])) : null,
                    'phone'=> !empty($request['phone']) ? removeCharEspeciais($request['phone']) : null,
                    'visibility'=> $request['visibility'],
                ];
                //RESGATAR DADOS DE MODO JOGADOR
                $player = $request['player'];
                //RESGATAR DADOS DE MODO TECNICO
                $manager = $request['manager'];
                //VERIFICAR SE FOI RECEBIDO FOTO DO USUÁRIO
                if($request->hasFile('photo')){
                    //RESGATAR RESQUEST PARA FUNÇÃO DE UPLOAD
                    $dataFile['request'] = $request;
                    //DEFINIR PASTA DE ARQUIVOS DO USUARIO
                    $dataFile['pasta'] = 'users/'.$data['uuid'];
                    //SALVAR FOTO DE USUARIO
                    $data['photo'] = upload($dataFile);
                }
                //REGISTRAR USUARIO
                $user = User::create($data);
                //VINCULAR DADOS DE JOGADOR AO USUARIO
                $this->userPlayer($player, $user->id);
                //VINCULAR DADOS DE TECNICO DO USUARIO
                $this->userManager($manager, $user->id);
                //CONSOLIDAR OPERAÇÃO
                DB::commit();
                return response()->json(['message' => 'Usuário registrado com sucesso!'], 200);
            }else{
                return response()->json(['message' => 'Os dados do usuário estão vazios!'], 400);
            }
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('registro')->error("[Erro de Registro][User][Registro]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            return response()->json(['message' => 'Houve um erro ao registrar o Usuário.'], 400);
        }
    }

    private function userManager($request, $user_id){
        //VERIFICAR SE DADOS DE TECNICO EXISTEM
        if(isset($request['team']) && !empty($request['team'])){
            //DEFINIR DADOS DE MODALIDADE TÉNICO
            $managerData = [
                'team'=> $request['team'],
                'alias'=> $request['alias'],
                'primary'=> $request['primary'],
                'secondary'=> $request['secondary'],
                'emblem'=> $request['emblem'],
                'uniform'=> $request['uniform'],
                'user_id' => $user_id,
            ];
            //ADICIONAR INFORMAÇÕES DE TÉCNICO DO USUARIO
            Manager::create($managerData);
        }
    }

    PRIVATE FUNCTION userPlayer($request, $user_id){
        if(isset($request['player']) && !empty($request['player'])){
            //DEFINIR DADOS DE MODALIDADE JOGADOR
            $playerData = [
                'best_side' => $request['bestSide'],
                'type' => $request['type'],
                'user_id' => $user_id,
            ];
            //ADICIONAR INFORMAÇÕES DE JOGADOR DO USUARIO
            Player::create($playerData);
            //VERIFICAR SE FORAM DEFINIDAS POSIÇÕES PARA O JOGADOR
            if(!empty($request['player']['positions']) && sizeof(json_decode($request['player']['positions'])) > 0){
                //LOOP NAS POSIÇÕES 
                foreach(json_decode($request['player']['positions']) as $key => $position){
                    //BUSCAR ID DA POSIÇÃO SELECIONADA
                    $position_id = Position::where('alias',$position)->first();
                    //VINCULAR POSIÇÃO AO JOGADOR
                    PlayerPosition::create([
                        'user_id' => $user_id,
                        'position_id' => $position->id,
                        'main' => $key == 'main' ? true : false
                    ]);
                }
            }
        }
    }
}
