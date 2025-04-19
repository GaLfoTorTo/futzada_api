<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function login(Request $request){
        //TENTAR EFETUAR LOGIN
        try {
            //VERIFICAR SE DADOS RECEBIDOS NÃO ESTÃO VAZIO
            if(!empty($request->all())){
                //VERIFICAR SE E LOGIN FEITO PELO GOOGLE
                ###
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
