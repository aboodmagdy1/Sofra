<?php

namespace App\Services\Admin;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class BaseDashboardService
{


    public function __construct(protected  $repository) {}

    public function all()
    {
        return $this->repository->all();
    }

    public function find(string $id)
    {
        try {
            return ['status' => true, 'data' => $this->repository->find($id)];
        } catch (QueryException $e) {
            return ['status' => false, 'message' => 'Database error , please try again '];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'server error when  finding record , try again '];
        }
    }
    public function filterd(array $filters)
    {
        return $this->repository->filter($filters);
    }

    public function create(array $data)
    {
        try {
            $this->repository->create($data);
            return ['status' => true];
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return ['status' => false, 'message' => 'Database error , please try again '];
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function update(string $id, array $data)
    {

        try {
            $this->repository->update($id, $data);
            return ['status' => true];
        } catch (QueryException $e) {
            return ['status' => false, 'message' => 'Database error , please try again '];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'server error when  updating record , try again '];
        }
    }

    public function delete(string $id)
    {
        try {
            $this->repository->delete($id);
            return ['status' => true];
        } catch (QueryException $e) {
            dd($e->getMessage());
            return ['status' => false, 'message' => 'Database error , please try again '];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'server error when  delete record , try again '];
        }
    }
}
