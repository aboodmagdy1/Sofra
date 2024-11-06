<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{

    public function all();

    public function filter(array $filters);
    public function find($id);

    public function findBy($key, $value);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
