<?php

namespace App\Services\Client;

use App\Repositories\Eloquent\ClientRepository;

use function App\Helpers\serviceResponse;

class ClientService
{
    public function __construct(private ClientRepository $repository) {}


    public function addReview($data)
    {
        $review =  request()->user()->reviews()->create($data);
        if (!$review) {
            return serviceResponse(0, 'error making review');
        }
        return serviceResponse(1, 'success', $review);
    }
}
