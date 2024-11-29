<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\UserRepository;
use Exception;

class UserService extends BaseDashboardService
{

    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data)
    {

        // hash password
        $data['password'] = bcrypt($data['password']);

        try {
            // create user
            $user = $this->repository->create($data);
            // assign role
            $user->assignRole($data['role']);
            $user->save();
            return ['status' => true];
        } catch (Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
    public function update(string $id, array $data)
    {

        try {
            // update user
            $user = $this->repository->update($id, $data);
            // assign role
            if (isset($data['role'])) {
                $user->syncRoles([$data['role']]);
            }
            $user->save();
            return ['status' => true];
        } catch (Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
