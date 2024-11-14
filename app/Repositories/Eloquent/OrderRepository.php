<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function findByClientAndStatus(string $clientId, array $statuses)
    {
        return $this->model->where('client_id', $clientId)->ofStatus($statuses)->get();
    }
    public function findByRestaurantAndStatus(string $restaurant_id, array $statuses)
    {
        return $this->model->where('restaurant_id', $restaurant_id)->ofStatus($statuses)->get();
    }
}
