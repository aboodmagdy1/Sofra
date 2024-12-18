<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(protected $model) {}
    public function all()
    {
        return   $this->model->paginate(5);
    }

    public function filter($filters)
    {
        return $this->model->filter($filters)->paginate(5);
    }

    public function findBy($key, $value)
    {
        return $this->model->where($key, $value)->first(); // return one instance of model 
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
    public function create(array $data)
    {
        return     $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }


    public function delete($id)
    {
        return   $this->find($id)->delete();
    }
}
