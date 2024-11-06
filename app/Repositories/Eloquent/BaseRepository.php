<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(protected $model) {}
    public function all()
    {
        return   $this->model->all();
    }

    public function filter($filters)
    {
        $query = $this->model->query();
        foreach ($filters as $key => $value) {
            if (!is_null($value)) {
                $query->where($key, $value);
            }
        }
        return $query->get();
    }

    public function findBy($key, $value)
    {
        return $this->model->where($key, $value)->first();
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
