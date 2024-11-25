<?php

namespace App\Services\Admin;


use App\Models\Category;
use App\Repositories\Eloquent\CategoryRepository;
use Exception;
use Illuminate\Database\QueryException;

class CategoryService
{
    public function __construct(private CategoryRepository $repository) {}

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

    public function update(Category $record, array $data)
    {
        try {
            $this->repository->update($record->id, $data);
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
            return ['status' => false, 'message' => 'Database error , please try again '];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'server error when  delete record , try again '];
        }
    }
}
