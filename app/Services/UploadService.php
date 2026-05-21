<?php

namespace App\Services;

use App\Repositories\RegisterRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\SubModulo;
use Image;

class UploadService
{
    public $model;
    public string $uField;
    public string $dField;
    protected string $folder;
    protected Request $request;

    public function __construct(Model $model){}

    //FUNÇÃO DE BUSCA DE ARQUIVOS SALVOS DO REGISTRO
    protected function getSavedFiles(): array{
        //BUSCAR REGISTRO
        $register = $this->model->find($this->request->id);
        //VERIFICAR SE REGISTRO EXISTE
        if (!empty($register) && !empty($register->{$this->uField})) {
            //COLETAR ARQUIVOS SALVOS
            return isJson($register->{$this->uField})
                ? json_decode($register->{$this->uField}, true)
                : (array) $register->{$this->uField};
        }
        return [];
    }

    //FUNÇÃO DEVERIFICAÇÃO DE ARQUIVOS SALVOS NO REGISTRO
    protected function verifySavedFiles(){
        //BUSCAR ARQUIVOS SALVOS
        $oldFiles = $this->getSavedFiles();
        //VERIFICAR SE EXISTEM ARQUIVOS SALVOS
        return !empty($oldFiles) && count($oldFiles) > 0;
    }

    //FUNÇÃO DE VERIFICAÇÃO DE ARQUIVOS NA REQUEST
    protected function verifyNewFiles(){
        //VERIFICAR SE EXISTEM ARQUIVOS NA REQUISIÇÃO
        if (isset($this->request[$this->uField])) {
            $files = $this->request[$this->uField];
            //VERIFICAR SE REQUISIÇÃO CONTEM MAIS DE 1 ARQUIVO
            if (is_array($files)) {
                foreach ($files as $file) {
                    return $file instanceof \Illuminate\Http\UploadedFile;
                }
            }
            //VERIFICAR SE REQUISIÇÃO CONTEM APENAS 1 ARQUIVO
            return $files instanceof \Illuminate\Http\UploadedFile;
        }
        return false;
    }

    //FUNÇÃO DE VERIFICAÇÃO DE ARQUIVOS DELETADOS NA REQUEST
    protected function verifyDeletedFiles(){
        //VERIFICAR SE EXISTEM ARQUIVOS DELETADOS NA REQUISIÇÃO
        if (isset($this->request[$this->dField])) {
            $files = $this->request[$this->dField];
            //VERIFICAR SE REQUISIÇÃO CONTEM MAIS DE 1 ARQUIVO
            if (is_array($files) && count($files) > 0) {
                return true;
            }
        }
        return false;
    }

    //FUNÇÃO DE INICIALIZAÇÃO 
    public function init(Request $request, string $field=null){
        //RESGATAR REQUEST E CAMPO DE UPLOAD
        $this->request = $request;
        $this->uField = !empty($field) ? $field : $this->uField;
        $this->dField = "{$this->uField}_deleted";
        $this->folder = "/user/";
        //VERIFICAR SE EXISTEM ARQUIVOS A SEREM ADICIONADOS
        $hasNewFiles = $this->verifyNewFiles();
        //VERIFICAR SE EXISTEM ARQUIVOS A SEREM DELETADOS
        $hasDeleteFiles = $this->verifyDeletedFiles();
        //REMOVER ARQUIVOS
        if ($hasDeleteFiles) {
            return $this->remove();
        }
        //ADICIONAR ARQUIVOS
        if($hasNewFiles){
            return $this->upload($this->request);
        }
        //ARQUIVOS SALVOS
        if($hasSavedFiles){
            return $this->getSavedFiles();
        }
        return null;
    }

    //FUNÇÃO DE UPLOAD DE ARQUIVOS
    public function upload(){
        //TENTAR FAZER UPLOAD
        try {
            //VERIFICAR SE REGISTRO CONTEM ARQUIVOS SALVOS
            $oldFiles = $this->getSavedFiles();
            //PREPARA ARQUIVOS
            $newFiles = $this->prepareFiles();
            //COMBINAR ARQUIVOS ANTIGOS COM NOVOS
            $newFiles = array_merge($oldFiles, $newFiles);
            //FILTRAR CAMINHOS DE ARQUIVOS VÁLIDOS
            $filteredFiles = array_filter($newFiles, function($file) {
                return !empty($file) && is_string($file) && trim($file) !== '';
            });
            //RETORNAR CAMINHO DOS ARQUIVOS COMO JSON
            return !empty($filteredFiles)? json_encode(array_values($filteredFiles)) : null;
        } catch (\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('arquivo')->error("[Erro de upload][Upload]",['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return json_encode(array_values($register[$this->uField])) ?? null;
        }
    }

    //FUNÇÃO DE REMOÇÃO DE ARQUIVOS
    public function remove() {
        //BUSCAR ARQUIVOS SALVOS
        $savedFiles = $this->getSavedFiles();
        try {
            $removedFiles = array_unique($this->request[$this->dField]);
            //REMOVER DUPLICAR E PPERCORRER ARQUIVOS 
            foreach ($removedFiles as $file) {
                //VERIFICAR SE AQUIVOS REALMENTE ESTA NOS ARQUIVOS SALVOS
                if (in_array($file, $savedFiles)) {
                    //REMOVER ARQUIVO DO ARRAY
                    $savedFiles = array_filter($savedFiles, fn ($saved) => !in_array($saved, $removedFiles, true));
                    $filePath = str_replace('/storage', '', $file);
                    //MOVER ARQUIVO PARA PASTA DE DELETADOS
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('deleted')->put($filePath, Storage::disk('public')->get($filePath));
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
            //FILTRAR CAMINHOS DE ARQUIVOS VÁLIDOS
            $filteredFiles = array_filter($savedFiles, function($file) {
                return !empty($file) && is_string($file) && trim($file) !== '';
            });
            //RETORNAR CAMINHO DOS ARQUIVOS COMO JSON
            return !empty($filteredFiles)? json_encode(array_values($filteredFiles)) : null;
        } catch (\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('arquivo')->error("[Erro ao Remover Arquivo][Upload]",['message' => $e->getMessage()]);
            return json_encode(array_values($savedFiles)) ?? null;
        }
    }

    //FUNÇÃO DE PREPARAÇÃO DE ARQUIVOS
    protected function prepareFiles(): array{
        //DEFINIR ARRAY DE NOVOS ARQUIVOS    
        $newFiles = [];
        //VERIFICAR SE FOI RECEBIDO MAIS DE 1 ARQUIVO
        $files = is_array($this->request->{$this->uField})
            ? $this->request->{$this->uField}
            : [$this->request->file($this->uField)];
        //RENOMEAR E MOVER ARQUIVO PARA STORAGE
        foreach ($files as $file) {
            //VERIFICAR SE ARQUIVO NO LOOP É VALIDO
            if (!$file instanceof \Illuminate\Http\UploadedFile && !$file->isValid()) {
                continue;
            }
            $fileName = renameData($file->getClientOriginalName());
            $newFiles[] = $this->moveFile($fileName, $file);
        }
        //RETORNAR ARRAY DE CAMINHOS DOS ARQUIVOS
        return $newFiles;
    }

    //FUNÇÃO DE MOVIMENTAÇÃO DE ARQUIVOS
    protected function moveFile(string $fileName, $file): ?string{
        //VERIFICAR SE ARQUIVO FORAM MOVIDOS PARA STORAGE E RETORNAR CAMINHO DO ARQUIVO
        if ($this->saveStorage($file, $this->folder, $fileName)) {
            return '/storage/' . $path . $fileName;
        }
        return null;
    }

    //FUNÇÃO PARA MOVIMENTAR ARQUIVO PARA STORAGE
    protected function saveStorage($file, string $path, string $fileName): bool{
        try {
            //RESGATAR EXTENSÃO DO ARQUIVO
            $ext = strtolower($file->getClientOriginalExtension());
            //VERIFICAR SE É UMA IMAGEM
            if (in_array($ext, ['png', 'jpeg', 'jpg', 'jiff'])) {
                $img = Image::make($file->path());
                //REDIMENCIONAR IMAGEM
                if ($img->width() > 800) {
                    $img->resize(800, null, function ($const) {
                        $const->aspectRatio();
                    });
                }
                //ADICIOANR AO STORAGE
                $img->stream();
                Storage::put($path . $fileName, $img);
            } else {
                //ADICIOANR AO STORAGE
                $file->storeAs($path, $fileName);
            }
            return true;
        } catch (\Exception $e) {
            Log::channel('arquivo')->error("[Erro de upload]",['message' => $e->getMessage()]);
            return false;
        }
    }
}