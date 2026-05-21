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
                //REGISTRAR USUARIO
                $user = User::create($data);
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
}
