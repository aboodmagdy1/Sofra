<?php

namespace App\Services\Admin;

use App\Models\City;
use App\Repositories\Eloquent\CityRepository;
use Exception;

class CityService
{
    public function __construct(protected  CityRepository $repository) {}

    public function index()
    {
        return $this->repository->all();
    }

    public function create(array $data)
    {
        $record = $this->repository->create($data);
        if (!$record) {
            return ['status' => false];
        }
        return ['status' => true];
    }

    public function update($data, City $record)
    {
        try {
            $record->update($data);
            return ['status' => true];
        } catch (Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function delete(City $record)
    {
        try {
            $record->delete();
            return ['status' => true];
        } catch (Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
