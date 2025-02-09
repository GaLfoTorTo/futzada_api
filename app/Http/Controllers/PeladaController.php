<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pelada;
use App\Models\Usuario;
use App\Models\Participante;

class PeladaController extends Controller
{
    public function create(Request $request){
        //INICIALIZAR TRANSAÇÃO NO DB
        DB::beginTransaction();
        //TENTAR SALVAR PELADA
        try {
            //VERIFICAR SE DADOS RECEBIDOS NÃO ESTÃO VAZIOS
            if(!empty($request->all())){
                //DEFINIR DADOS BASICOS DA PELADA
                $dadosBasicos = [
                    'uuid' => (string) Str::uuid(),
                    'nome'=> $request['nome'],
                    'bio'=> $request['bio'],
                    'local_fixo'=> isset($request['localFixo']) && !empty($request['localFixo']) ? true : false,
                    'endereco'=> $request['endereco'],
                    'dia_semana'=> json_encode($request['dia_semana']),
                    'data'=> data('Y-m-d', strtotime($request['data'])),
                    'horario'=> data('Y-m-d', strtotime($request['horario'])),
                    'categoria'=> $request['categoria'],
                    'qtd_jogadores'=> $request['qtd_jogadores'],
                    'telefone'=> !empty($request['telefone']) ? removeCharEspeciais($request['telefone']) : null,
                    'visibilidade'=> $request['visibilidade'],
                ];
                //VERIFICAR SE FOI RECEBIDO FOTO DO USUÁRIO
                if($request->hasFile('foto')){
                    //RESGATAR RESQUEST PARA FUNÇÃO DE UPLOAD
                    $data['request'] = $request;
                    //DEFINIR PASTA DE ARQUIVOS DO USUARIO
                    $data['pasta'] = 'usuarios/'.$dadosBasicos['uuid'];
                    //SALVAR FOTO DE USUARIO
                    $dadosBasicos['foto'] = upload($data);
                }
                //REGISTRAR USUARIO
                $usuario = Usuario::create($dadosBasicos);
                //VERIFICAR SE DADOS DE TECNICO EXISTEM
                if(isset($request['equipe']) && !empty($request['equipe'])){
                    //DEFINIR DADOS DE MODALIDADE TÉNICO
                    $dadosTecnico = [
                        'equipe'=> $request['equipe'],
                        'sigla'=> $request['sigla'],
                        'primaria'=> $request['primaria'],
                        'secundaria'=> $request['secundaria'],
                        'emblema'=> $request['emblema'],
                        'uniforme'=> $request['uniforme'],
                        'usuario_id' => $usuario->id,
                    ];
                    //ADICIONAR INFORMAÇÕES DE TÉCNICO DO USUARIO
                    Tecnico::create($dadosTecnico);
                }
                //VERIFICAR SE DADOS DE TECNICO EXISTEM
                if(isset($request['posicoes']) && !empty($request['posicoes'])){
                    //DEFINIR DADOS DE MODALIDADE JOGADOR
                    $dadosJogador = [
                        'melhorPe' => $request['melhorPe'],
                        'arquetipo' => $request['arquetipo'],
                        'usuario_id' => $usuario->id,
                    ];
                    //ADICIONAR INFORMAÇÕES DE JOGADOR DO USUARIO
                    Jogador::create($dadosJogador);
                    //LOOP NAS POSIÇÕES 
                    foreach(json_decode($request['posicoes']) as $key => $posicao){
                        //BUSCAR ID DA POSIÇÃO SELECIONADA
                        $posicao_id = Posicao::where('sigla',$posicao)->first();
                        //VINCULAR POSIÇÃO AO JOGADOR
                        JogadorPosicao::create([
                            'usuario_id' => $usuario->id,
                            'posicao_id' => $posicao_id->id,
                            'principal' => $key == 'principal' ? true : false
                        ]);
                    }
                }
                //CONSOLIDAR OPERAÇÃO
                DB::commit();
                return response()->json(['message' => 'Pelada registrado com sucesso!'], 200);
            }else{
                return response()->json(['message' => 'Os dados da Pelada estão vazios!'], 400);
            }
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('registro')->error("[Erro de Registro][Usuario][Registro]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            return response()->json(['message' => 'Houve um erro ao registrar o Usuário.'], 400);
        }
    }
}
