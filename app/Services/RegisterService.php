<?php

namespace App\Services;

use App\Repositories\RegisterRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\SubModulo;

class RegisterService
{
    public $repository;

    public function __construct($model){   
        //MONTAR MODEL DINAMICAMENTE
        $class = 'App\\Models\\' . $model;
        //VERIFICAR SE A CLASSE EXISTE
        if (!class_exists($class)) {
            throw new \Exception("Model {$class} não encontrado.");
        }
        //INSTANCIAR REPOSITORY COM MODULO RECEBIDO
        $this->repository = new RegisterRepository($class);
        return $this;
    }

    //FUNÇÃO PARA RESGATAR METADADOS DO MODULO ATUAL
    public function getModulo($namespace){
        return SubModulo::where('namespace','App\\Models\\'.$namespace)->first();
    }

    //FUNÇÃO PARA RESGATAR AÇÃO DE FORMULÁRIO APARTIR DA ROTA
    public function getAction(){
        //RESGATAR NAME DA ROTA
        $routeName = explode('.', request()->route()->getName())[2];
        //RETORNAR AÇÃO DO FORMULÁRIO
        return $routeName != "Novo" ? $routeName : "Registrar";
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    //SERVIÇO PARA BUSCA DE REGISTROS PAGINADOS
    public function getPaginated(int $pages = 10)
    {
        return $this->repository->paginate($pages);
    }

    //SERVIÇO PARA BUSCA DE REGISTROS POR CAMPO
    public function getByField(string $field, $value, $relations = [])
    {
        return $this->repository->findByField($field, $value, $relations);
    }
    
    //SERVIÇO PARA BUSCA VARIOS DE REGISTROS POR CAMPO
    public function getManyByField(string $field, $value, $relations = [])
    {
        return $this->repository->findManyByField($field, $value, $relations);
    }

    //SERVIÇO PARA BUSCA DE REGISTROS POR ID
    public function getById($id, $relations = [])
    {
        return $this->repository->find($id, $relations);
    }

    //SERVIÇO DE CRIAÇÃO DE NOVO REGISTRO
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    //SERVIÇO DE ATUALIZAÇÃO DE REGISTRO
    public function update(array $data)
    {
        return $this->repository->update($data);
    }
    
    //SERVIÇO DE EXCLUSÃO DE REGISTRO
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
    
    //SERVIÇO DE DUPLICAÇÃO DE REGISTRO
    public function duplicate($items)
    {
        return $this->repository->duplicate($items);
    }
    
    //SERVIÇO DE AGRUPAMENTO DE REGISTRO
    public function agroup(string $data)
    {
        return $this->repository->agroup($data);
    }
}
