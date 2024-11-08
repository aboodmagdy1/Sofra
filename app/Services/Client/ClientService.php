<?php

namespace App\Services\Client;

use App\Repositories\Eloquent\ClientRepository;

use App\Services\BaseAuthService;

class ClientService extends BaseAuthService
{
    public function __construct(private ClientRepository $repository)
    {
        parent::__construct($repository);
    }


    public function addReview($data)
    {
        $review =  request()->user()->reviews()->create($data);
        if (!$review) {
            return ['status' => false, 'message' => 'Failed to add review'];
        }
        return ['status' => true, "data" => $review];
    }
}
