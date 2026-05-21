<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Services\UploadService;
use App\Models\User;
use App\Models\UserLevel;
use App\Models\UserConfig;
use App\Models\Player;
use App\Models\Manager;
use App\Models\Participant;

class UserService
{
    //FUNÇÃO DE CRIAÇÃO DE USUARIOS
    public function create($data){
        //INICIALIZAR TRANSAÇÃO NO DB
        DB::beginTransaction();
        try {
            //$uploadService = new UploadService(User::class);
            //DEFINIR DADOS BASICOS DO USUARIO
            $dataForm = [
                'uuid' => (string) Str::uuid(),
                'first_name'=> ucfirst($data['first_name'] ?? $data['given_name'] ?? explode(" ", $data['name'])[0]),
                'last_name'=> ucfirst($data['last_name'] ?? $data['family_name'] ?? explode(" ", $data['name'])[1]),
                'user_name'=> $data['user_name'] ?? null,
                'email'=> $data['email'],
                'password'=> $data['password'] ?? null,
                'born_date'=> $data['born_date'] ?? null,
                'phone'=> $data['phone'] ?? null,
                "photo" => $data['photo'] ?? $data['picture'] ?? null,
                'privacy'=> $data['privacy'] ?? true,
            ];
            //UPLOAD DE ARQUIVOS
            //$formData['photo'] = $uploadService->init($data, 'photo');
            //REGISTRAR USUARIO
            $user = User::create($dataForm);
            //CRIAR LEVEL
            UserLevel::create([
                'user_id' => $user->id,
                'level_id' => 1,
                'points' => 0
            ]);
            //CRIAR CONFIG
            if(!empty($data['config'])){
            }
            //CRIAR VINCULO DE PALYER
            if(!empty($data['player'])){
            }
            //CRIAR VINCULO DE MANAGER
            if(!empty($data['manager'])){
            }
            //CONSOLIDAR OPERAÇÃO
            DB::commit();
        } catch (\Exception $e) {
            //RETROCEDER 
            DB::rollback();
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('auth')->error("[Erro ao criar o usuario][Auth]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            throw $e;
        }
    }

    //FUNÇÃO CRIAÇÃO DE VINCULO DE TECNICO
    public function userManager($request, $user_id){
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

    //FUNÇÃO CRIAÇÃO DE VINCULO DE JOGADOR
    public function userPlayer($request, $user_id){
        if(isset($request['player']) && !empty($request['player'])){
            //DEFINIR DADOS DE MODALIDADE JOGADOR
            $playerData = [
                'user_id' => $user_id,
                'best_side' => $request['bestSide'],
                'type' => $request['type'],
                'main_position'=> $request['main_position'],
                'positions'=> json_decode($request['positions']),
            ];
            //ADICIONAR INFORMAÇÕES DE JOGADOR DO USUARIO
            Player::create($playerData);
        }
    }
}
