<?php

namespace App\Services\Restaurant;

use App\Repositories\Eloquent\RestaurantRepository;
use function App\Helpers\serviceResponse;

class RestaurantService
{
    public function __construct(private RestaurantRepository $repository) {}

    public function list($district_id, $name)
    {
        $restaurants =  $this->repository->filter(['district_id' => $district_id, 'name' => $name]);
        if (count($restaurants) > 0) {
            return serviceResponse(1, 'succes', $restaurants);
        }
        return serviceResponse(0, 'no data found', []);
    }

    public function show($restaurant_id)
    {
        $restaurant = $this->repository->find($restaurant_id);
        if ($restaurant) {
            $restaurant->meals = $restaurant->meals()->paginate(10);
            $restaurant->reviews = $restaurant->reviews()->paginate(5);
            return serviceResponse(1, 'success', $restaurant);
        }
        return serviceResponse(0, 'no data found', []);
    }


    public function reviews()
    {
        $restaurant = $this->repository->find(request()->user()->id);
        $reviews = $restaurant->reviews()->paginate(5);
        if ($reviews) {
            return serviceResponse(1, 'success', $reviews);
        }
        return serviceResponse(0, 'no data found', []);
    }
}
