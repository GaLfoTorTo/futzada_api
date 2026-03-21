<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegisterRepository
{
    public $model;

    public function __construct(string $model = null)
    {
        $this->setModel($model);
    }

    //FUNÇÃO DE DEFINIÇÃO DE MODEL DINAMICA
    public function setModel(string $modelClass = null)
    {
        //INSTANCIAR MODEL RECEBIDA
        $model = app($modelClass);
        //VERIFICAR SE MODEL FOI INSTANCIADA CORRETAMENTE
        if (!$model instanceof Model) {
            throw new Exception("Class {$modelClass} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        //ATRIBUIR MODEL AO REPOSITORY
        $this->model = $model;
        return $this;
    }

    //FUNÇÃO DE BUSCA DE TODOS OS REGISTROS
    public function all()
    {
        return $this->model->all();
    }

    //FUNÇÃO DE BUSCA PAGINADA
    public function paginate(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    //FUNÇÃO DE BUSCA POR ID
    public function find(int $id, array $relations=[])
    {
        return $this->model->with($relations)->find($id);
    }

    //FUNÇÃO DE BUSCA POR CAMPO ESPECÍFICO
    public function findByField(string $field, $value, $relations=[])
    {
        return $this->model->with($relations)->where($field, $value)->first();
    }

    //FUNÇÃO DE BUSCA POR CAMPO ESPECÍFICO
    public function findManyByField(string $field, array $value, array $relations=[])
    {
        return $this->model->with($relations)->where($field, $value)->get();
    }

    //FUNÇÃO DE CRIAÇÃO DE NOVO REGISTRO
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    //FUNÇÃO DE ATUALIZAÇÃO DE REGISTROS
    public function update(array $data)
    {
        $record = $this->model->findOrFail($data['id']);
        $record->update($data);
        return $record;
    }

    //FUNÇÃO DE REMOÇÃO DE REGISTRO
    public function delete($id)
    {
        $record = $this->model->findOrFail($id);
        return $record->delete();
    }
}