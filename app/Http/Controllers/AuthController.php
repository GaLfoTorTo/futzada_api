<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Google\Client as GoogleClient;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{
    //FUNÇÃO DE LOGIN
    public function login(Request $request){
        //TENTAR EFETUAR LOGIN
        try {
            //VERIFICAR SE DADOS RECEBIDOS NÃO ESTÃO VAZIO
            if(!empty($request->all())){
                //REQUEST CREDENCIAIS 
                $credentials = $request->only('user', 'password');
                //INICIALIZAR USUARIO
                $user = null;
                //VERIFICAR TIPO DE AUTENTICAÇÃO (EMAIL OU USERNAME)
                if (filter_var($credentials['user'], FILTER_VALIDATE_EMAIL)) {
                    //TENTAR AUTENTICAR PELO EMAIL
                    $credentials = ['email' => $credentials['user'], 'password' => $credentials['password']];
                    //BUSCAR USUARIO 
                    $user = User::with('player','manager')->where('email', $credentials['email'])->first();
                } else {
                    //TENTAR AUTENTICAR PELO USER NAME
                    $credentials = ['user_name' => $credentials['user'], 'password' => $credentials['password']];
                    //BUSCAR USUARIO 
                    $user = User::with('player','manager')->where('user_name', $credentials['user_name'])->first();
                }
                //VERIFICAR SE CREDENCIAIS DO USUARIO SÃO VALIDAS
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json(['message' => 'E-mail/Usuario ou senha estão incorretos'], 401);
                }
                //ADICIONAR TOKEN AOS DADOS DO USUARIO
                $user['token'] = $token; 
                //AJUSTAR DADOS DO USUARIO (TRANSFORMAR SNACK_CASE PARA CAMELCASE)
                $user = new UserResource($user);
                //RETORNAR DADOS PARA AUTENTICAÇÃO
                return response()->json(['user' => $user], 200);
            }
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('auth')->error("[Erro de autenticação][Usuario][Auth]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            return response()->json(['message' => 'Houve um erro ao efetura login. Tente novamente mais tarde!'], 500);
        }
    }

    //FUNÇÃO DE LOGIN COM GOOGLE
    public function loginGoogle(Request $request){
        //TENTAR EFETUAR LOGIN
        try {
            //VERIFICAR TOKEN DE AUTENTICAÇÃO COM O GOOGLE
            $client = new GoogleClient(['client_id' => config('services.google.client_id')]);
            $payload = $client->verifyIdToken($request->id_token);
            if (!$payload) {
                //REGISTRAR ERRO DE LOGIN
                Log::channel('auth')->error('Token inválido do Google', [
                    'token' => substr($request->id_token, 0, 50) . '...',
                    'client_id' => config('services.google.client_id')
                ]);
                return response()->json(['message' => 'Não foi possível fazer login, tente novamente.'], 401);
            }
            //VERIFICAR SE DADOS RECEBIDOS NÃO ESTÃO VAZIO
            if(!empty($payload['email'])){
                //INIICIALIZAR USUARIO
                $user;
                //BUSCAR USUARIO 
                $user = User::with('player','manager')->where('email', $payload['email'])->first();
                if(empty($user)){
                    //DEFINIR DADOS BASICOS DO USUARIO
                    $data = [
                        'uuid' => (string) Str::uuid(),
                        'first_name'=> explode(" ", $payload['name'])[0],
                        'last_name'=> explode(" ", $payload['name'])[1],
                        'user_name'=> null,
                        'email'=> $payload['email'],
                        'password'=> null,
                        'born_date'=> null,
                        'phone'=> null,
                        "photo" => $payload['picture'],
                        'visibility'=> true,
                    ];
                    //REGISTRAR USUARIO
                    $user = User::create($data);
                }
                //ADICIONAR TOKEN AOS DADOS DO USUARIO
                $user['token'] = JWTAuth::fromUser($user);
                //AJUSTAR DADOS DO USUARIO (TRANSFORMAR SNACK_CASE PARA CAMELCASE)
                $user = new UserResource($user);
                //RETORNAR DADOS PARA AUTENTICAÇÃO
                return response()->json(['user' => $user], 200);
            }
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('auth')->error("[Erro de autenticação][Usuario][Auth]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            return response()->json(['message' => 'Houve um erro ao efetura login. Tente novamente mais tarde!'], 500);
        }
    }

    //FUNÇÃO DE LOGOUT
    public function logout(Request $request){
        try {
            //VERIFICAR SE UUID DO USUARIO FOI ENVIADO
            if(!empty($request->all()) && isset($request['uuid'])){
                //INVALIDAR TOKEN
                JWTAuth::invalidate(JWTAuth::getToken());
                //RETORNAR MENSAGEM DE LOGOUT
                return response()->json(['user' => null],200);
            }else{
                //RETORNAR MENSAGEM DE LOGOUT
                return response()->json(['message' => 'Houve um erro ao efetura logout. Usuario não especificado!'], 500);
            }
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('auth')->error("[Erro de Logout][Usuario][Auth]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            return response()->json(['message' => 'Houve um erro ao efetura logout. Tente novamente mais tarde!'], 500);
        }
    }
}
