<?php

namespace App\Services\Client;

use App\Http\Requests\Api\Client\RegisterRequest;
use App\Http\Requests\Api\Client\ResetPasswordRequest;
use App\Http\Requests\Api\Client\UpdateProfileRequest;
use App\Mail\ForgetPasswordMail;
use App\Repositories\Eloquent\ClientRepository;
use App\Services\BaseAuthService;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use function App\Helpers\deleteImage;
use function App\Helpers\serviceResponse;
use function App\Helpers\uploadImage;

class ClientAuthService extends BaseAuthService
{


    public function __construct(protected ClientRepository $repository)
    {
        parent::__construct($repository);
    }
}
