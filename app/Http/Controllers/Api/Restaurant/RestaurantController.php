<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Services\Restaurant\RestaurantService;
use function App\Helpers\responseJson;

class RestaurantController
{
    public function __construct(private RestaurantService $service) {}
    public function listReviews()
    {
        $result = $this->service->reviews();
        if ($result['status']) {
            return responseJson(1, 'Reviews retrieved successfully', $result['data']);
        }
        return responseJson(0, $result['message']);
    }
}
