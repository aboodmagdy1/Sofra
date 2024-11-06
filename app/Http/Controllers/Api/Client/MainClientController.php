<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\CreateReviewRequest;
use App\Services\Client\ClientService;
use Illuminate\Http\Request;

class MainClientController extends Controller
{

    public function __construct(private ClientService $service) {}

    public function addReview(CreateReviewRequest $request)
    {
        $data = $request->validated();
        $result =  $this->service->addReview($data);
        return response()->json($result);
    }
}
