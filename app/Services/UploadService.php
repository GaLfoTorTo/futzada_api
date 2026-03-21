<?php

namespace App\Services;

use App\Repositories\RegisterRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\SubModulo;
use Image;

class UploadService
{
    public $repository;
    public $modulo;
    protected string $namespace;
    public string $field;
    protected string $folder;
    protected $request;

    public function __construct(string $modelClass){   
        //MONTAR MODEL DINAMICAMENTE
        $class = 'App\\Models\\' . $modelClass;
        //VERIFICAR SE A CLASSE EXISTE
        if (!class_exists($class)) {
            throw new \Exception("Model {$class} não encontrado.");
        }
        //INSTANCIAR REPOSITORY COM MODULO RECEBIDO
        $this->repository = new RegisterRepository($class);
        //INSTANCIAR METADATA DO MODULO RECEBIDO
        $this->modulo = $this->getModulo($modelClass);
        $this->namespace = $class;
        $this->field = method_exists($this->repository->model, 'getUploadField') ? $this->repository->model->getUploadField() : 'documentos';
        $this->folder = $this->getFolder();
        return $this;
    }

    //FUNÇÃO PARA RESGATAR METADADOS DO MODULO ATUAL
    public function getModulo($namespace){
        return SubModulo::where('namespace','App\\Models\\'.$namespace)->first();
    }

    //FUNÇÃO DE DEFINIÇÃO DA PASTA DE DESTINO
    protected function getFolder(): string{
        //MODELS A SEREM IGNORADAS
        $ignorar = [
            "App\Models\Empresa",
            "App\Models\InformacoesLegaisEmpresa",
            "App\Models\Colaborador",
        ];
        //DEFINIR PASTA DE DESTINO PARA PLANO EP
        if (str_contains($this->namespace, 'PlanoEpEnsaio')) {
            return '/documentos/plano_ep/' . date('Y/m/d') . '/';
        }
        
        //DEFINIR PASTA DE DESTINO PARA DEMAIS MODULOS
        if (!in_array($this->namespace, $ignorar)) {
            return '/documentos/' . $this->modulo->route . '/' . date('Y/m/d') . '/';
        }

        return '/documentos/geral/' . date('Y/m/d') . '/';
    }

    //FUNÇÃO DE INICIALIZAÇÃO 
    public function initUpload($request){
        //DEFINIR CAMPO DE DOCUMENTOS
        $uploadField = $this->field;
        //VERIFICAR SE EXISTEM ARQUIVOS NA REQUISIÇÃO
        if(!empty($request[$uploadField]) || !empty($request["{$uploadField}_deleted"])){
            //VERIFICAR SE HÁ ALGUM NOVO ARQUIVO INSERIDO OU ALGUM À SER REMOVIDO (DOCUMENTOS)
            if($request->hasFile("{$uploadField}") || isset($request["{$uploadField}_deleted"])){
                //VERIFICAR SE EXISTEM ARQUIVOS A SEREM EXCLUIDOS
                if(isset($request["{$uploadField}_deleted"]) && sizeof($request["{$uploadField}_deleted"]) > 0){
                    //REMOVER ARQUIVOS
                    return $this->remove($request["{$uploadField}_deleted"]);
                }
                //VERIFICAR SE EXISTEM ARQUIVOS A SEREM ADICIONADOS
                if($request->hasFile("{$uploadField}")){
                    //ADICIONAR ARQUIVOS
                    return $this->upload($request);
                }
            }
        }
        return null;
    }

    //FUNÇÃO DE UPLOAD DE ARQUIVOS
    public function upload($request){
        //RESGATAR DADOS DA REQUEST
        $this->request = $request;
        //TENTAR FAZER UPLOAD
        try {
            //RESGATAR REGISTRO
            $register = isset($this->request->id)
                ? $this->repository->model->find($this->request->id)
                : null;
            //VERIFICAR SE REGISTRO CONTEM ARQUIVOS SALVOS
            $oldFiles = $register ? $this->getOldFiles($register) : [];
            //PREPARA ARQUIVOS
            $newFiles = $this->prepareFiles($oldFiles);
            //RETORNAR CAMINHO DOS ARQUIVOS
            return !empty($newFiles) && is_array($newFiles) && sizeof($newFiles) > 0 ? json_encode($newFiles) : null;
        } catch (\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('arquivo')->error("[Erro de upload][{$this->modulo->nome}][form_id={$this->request->id}]",['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return $register[$this->field] ?? null;
        }
    }

    //FUNÇÃO DE REMOÇÃO DE ARQUIVOS
    public function remover(array $removedFiles): array {
        //RESGATAR ARQUIVOS DO REGISTRO
        $registro = $this->repository->model->find($this->request->id);
        $currentFiles = $this->getOldFiles($registro);

        try {
            //REMOVER DUPLICAR E PPERCORRER ARQUIVOS 
            foreach (array_unique($removedFiles) as $file) {
                //VERIFICAR SE AQUIVOS REALMENTE ESTA NOS ARQUIVOS SALVOS
                if (in_array($file, $currentFiles)) {
                    $key = array_search($file, $currentFiles);
                    unset($currentFiles[$key]);
                    $filePath = str_replace('/storage', '', $file);
                    //MOVER ARQUIVO PARA PASTA DE DELETADOS
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('deleted')->put($filePath, Storage::disk('public')->get($filePath));
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
            //VERIFICAR SE SOBROU ALGUM ARQUIVO 
            return !empty($currentFiles)
                ? json_encode(array_values($currentFiles))
                : null;
        } catch (\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('arquivo')->error("[Erro ao Remover Arquivo][{$this->modulo->nome}][form_id={$this->request->id}]",['message' => $e->getMessage()]);
            return $currentFiles;
        }
    }

    //FUNÇÃO DE VERIFICAÇÃO DE ARQUIVOS NO REGISTRO
    protected function getOldFiles($register): array{
        if (!empty($register) && !empty($register->{$this->field})) {
            return isJson($register->{$this->field})
                ? json_decode($register->{$this->field}, true)
                : (array)$register->{$this->field};
        }
        return [];
    }

    //FUNÇÃO DE PREPARAÇÃO DE ARQUIVOS
    protected function prepareFiles(array $files): array{
        $newFiles = $files;
        //VERIFICAR SE FORAM RECEBIDOS ARQUIVOS NA REQUEST
        if ($this->request->hasFile($this->field) && !empty($this->request[$this->field])) {
            //VERIFICAR SE FOI RECEBIDO MAIS DE 1 ARQUIVO
            $files = is_array($this->request->{$this->field})
                ? $this->request->{$this->field}
                : [$this->request->file($this->field)];
            //RENOMEAR E MOVER ARQUIVO PARA STORAGE
            foreach ($files as $file) {
                $fileName = renameData($file->getClientOriginalName());
                $newFile = $this->moveFile($fileName, $file);
                //VERIFICAR SE ARQUIVOS FORAM MOVIDOS CORRETAMENTE
                if ($newFile) {
                    $newFiles[] = $newFile;
                }
            }
        }
        //RETORNAR ARRAY DE CAMINHOS DOS ARQUIVOS
        return $newFiles;
    }

    //FUNÇÃO DE MOVIMENTAÇÃO DE ARQUIVOS
    protected function moveFile(string $fileName, $file): ?string{
        //MONTAR CAMINHO DE UPLOAD PARA A EMPRESA
        $uuid = auth()->user()->empresa->uuid;
        $path = 'uploads/empresas/' . $uuid . $this->folder;
        //VERIFICAR SE ARQUIVO FORAM MOVIDOS PARA STORAGE E RETORNAR CAMINHO DO ARQUIVO
        if ($this->saveStorage($file, $path, $fileName)) {
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