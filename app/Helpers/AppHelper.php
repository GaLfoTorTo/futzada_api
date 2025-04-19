<?php

//namespace App\Helpers;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

// FUNÇÃO PARA UPLOAD DE ARQUIVOS
function upload($data) {
    //TENTAR SALVAR O USUÁRIO
    try {
        // REGATAR OBJETO DA REQUEST
        $request = $data['request'];
        // DEFININDO PASTA ONDE SERÃO SALVOS OS ARQUIVOS
        $pasta = $data['pasta'];
        // VERIFICAR SE EXISTE UM ARQUIVO NOS DADOS RECEBIDOS
        if ($request->hasFile('photo')) {
            // RESGATAR ARQUIVO
            $file = $request->file('photo');
            // RENOMEAR ARQUIVO
            $nome_arquivo = renameData($file->getClientOriginalName());
            // RESGATAR A EXTENSÃO ORIGINAL DO ARQUIVO
            $ext = $file->getClientOriginalExtension();
            // DEFINIR CAMINHO DE SALVAMENTO DO ARQUIVO 
            $path_file = 'public/upload/' . $pasta . '/' . $nome_arquivo;
            // VERIFICAR SE A EXTENSÃO DO ARQUIVO É OU NÃO UMA IMAGEM
            if (in_array($ext, ['png', 'jpeg', 'jpg', 'jiff'])) {
                // SE FOR, CRIAR INSTÂNCIA DE IMAGE A PARTIR DA IMAGEM ENVIADA
                $img = Image::read($file->path());
                // RESGATAR LARGURA
                $width = $img->width();
                // VERIFICAR SE A LARGURA É MAIOR QUE 800 PX
                if ($width > 1024) {
                    // SE MAIOR, REDIMENSIONAR IMAGEM PARA UMA LARGURA DE 1024 PX MANTENDO ALTURA COMPATÍVEL
                    $img->resize(1024, null, function ($const) {
                        $const->aspectRatio();
                    });
                }
                // MOVER IMAGEM PARA O CAMINHO INDICADO NA STORAGE
                $imgData = (string) $img->encode();
                Storage::put($path_file, $imgData);
                // RETORNAR CAMINHO DA IMAGEM
                return '/storage/'.$path_file;     
            }
        }
    }catch(\Exception $e) {
        //CAPTURAR ERRO E ENVIAR PARA O LOG
        Log::channel('arquivos')->error("[Erro de upload arquivos][Usuario][Arquivos]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
        //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
        return ['message' => 'Houve um erro ao salvar o arquivo.'];
    }
}

//FUNÇÃO DE SLUG PARA REMOVER CARACTERS ESPECIAIS
function renameData($nome){
    //REMOVER ESPAÇOS VAZIOS
    $new_name = str_replace(' ', '_', $nome);
    //MAPEAR CARACTERES ESPECIAIS
    $map = [
        'a' => ['à', 'á', 'â', 'ã', 'ä', 'å', 'ª'],
        'c' => ['ç'],
        'e' => ['è', 'é', 'ê', 'ë'],
        'i' => ['ì', 'í', 'î', 'ï'],
        'n' => ['ñ'],
        'o' => ['ò', 'ó', 'ô', 'õ', 'ö', 'º', '°'],
        'u' => ['ù', 'ú', 'û', 'ü'],
        'y' => ['ý', 'ÿ'],
        'A' => ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å'],
        'C' => ['Ç'],
        'E' => ['È', 'É', 'Ê', 'Ë'],
        'I' => ['Ì', 'Í', 'Î', 'Ï'],
        'N' => ['Ñ'],
        'O' => ['Ò', 'Ó', 'Ô', 'Õ', 'Ö'],
        'U' => ['Ù', 'Ú', 'Û', 'Ü'],
        ''  => ['.', ',', '!', '@', '#', '$', '%', '¨', '&', '*', '+', '=', '[', '{', ']', '}', '?', ';', ':']
    ];
    // Substituir caracteres especiais com base no mapeamento
    //LOOP NO MAPA DE CARACTERES
    foreach ($map as $replacement => $chars) {
        //SUBSTITUIR CARACTERES ESPECIAIS COM BASE NO MAPA
        $new_name = str_replace($chars, $replacement, $new_name);
    }
    //REMOVER ESPAÇOS VAZIOS
    $new_name = str_replace(' ', '_', $nome);
    //RETORNAR NOME AJUSTADO
    return $new_name;
}

function removeCharEspeciais($text){
    //REMOVER ESPAÇOS
    $new_text = str_replace(' ', '', $text);
    //PADRÃO DE CARACTERES ESPECIAIS
    $padrao = '/[^a-zA-Z0-9\s]/';
    //SUBISTITUIR CARACTERS
    $new_text = preg_replace($padrao, '', $new_text);
    //RETORNAR NOVO TEXTO
    return $new_text;
}