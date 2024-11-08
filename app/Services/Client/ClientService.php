<?php

namespace App\Services\Client;

use App\Repositories\Eloquent\ClientRepository;

use App\Services\BaseAuthService;
use function App\Helpers\serviceResponse;

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
            return serviceResponse(0, 'error making review');
        }
        return serviceResponse(1, 'success', $review);
    }
}
