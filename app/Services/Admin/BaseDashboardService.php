<?php

namespace App\Services\Admin;

use Exception;
use Illuminate\Database\QueryException;

class BaseDashboardService
{


    public function __construct(protected  $repository) {}

    public function all()
    {
        return $this->repository->all();
    }

    public function create(array $data)
    {
        try {
            $this->repository->create($data);
            return ['status' => true];
        } catch (QueryException $e) {
            return ['status' => false, 'message' => 'Database error , please try again '];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'server error when  creating record , try again '];
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
