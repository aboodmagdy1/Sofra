<?php

namespace App\Services\Restaurant;

use App\Repositories\Eloquent\RestaurantRepository;
use App\Services\BaseAuthService;

class RestaurantService extends BaseAuthService
{
    public function __construct(private RestaurantRepository $repository)
    {
        parent::__construct($repository);
    }

    public function list($district_id, $name)
    {
        $records =  $this->repository->filter(['district_id' => $district_id, 'name' => $name]);
        if ($records) {
            return ['status' => true, 'data' => $records];
        }
        return ['status' => false, 'message' => 'No records found'];
    }

    public function show($restaurant_id)
    {
        $record = $this->repository->find($restaurant_id);
        if ($record) {
            $record->meals = $record->meals()->paginate(10);
            $record->reviews = $record->reviews()->paginate(5);

            return ['status' => true, 'data' => $record];
        }
        return ['status' => false, 'message' => 'No records found'];
    }


    public function reviews()
    {
        $restaurant = $this->repository->find(request()->user()->id);
        $records = $restaurant->reviews()->paginate(5);
        if ($records) {
            return ['status' => true, 'data' => $records];
        }
        return ['status' => false, 'message' => 'No records found'];
    }
}
