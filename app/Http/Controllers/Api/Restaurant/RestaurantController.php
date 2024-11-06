<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Services\Restaurant\RestaurantService;

class RestaurantController
{
    public function __construct(private RestaurantService $service) {}
    public function listReviews()
    {
        $result = $this->service->reviews();
        return response()->json($result);
    }
}
