<?php

namespace App\Services\Restaurant;

use App\Mail\ForgetPasswordMail;
use App\Repositories\Eloquent\RestaurantRepository;
use App\Services\BaseAuthService;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use function App\Helpers\deleteImage;
use function App\Helpers\serviceResponse;
use function App\Helpers\uploadImage;

class RestaurantAuthServuce extends BaseAuthService
{

    public function __construct(private RestaurantRepository $repository)
    {
        parent::__construct($repository);
    }
}
