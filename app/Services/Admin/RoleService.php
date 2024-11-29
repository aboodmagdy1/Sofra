<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\RoleRepository;
use Exception;
use Spatie\Permission\Models\Role;

class RoleService extends BaseDashboardService
{

    public function __construct(RoleRepository $repository)
    {
        parent::__construct($repository);
    }
    public function create(array $deta)
    {
        try {
            $role = $this->repository->create(['name' => $deta['name']]);
            $role->syncPermissions($deta['permissions']);
            return ['status' => true];
        } catch (Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
    public function update(string $id, array $data)
    {

        try {
            $role = $this->repository->find($id);
            if ($data['name'] != $role->name) {
                $role->update(['name' => $data['name']]);
            }
            if ($data['permissions']) {

                $role->syncPermissions($data['permissions']);
            }
            $role->save();
            return ['status' => true];
        } catch (Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
