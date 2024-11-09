<?php

namespace App\Services\Client;

use App\Enums\OrderStatus;
use App\Enums\RestaurantStatus;
use App\Models\Meal;
use App\Models\Restaurant;
use App\Repositories\Eloquent\ClientRepository;

use App\Services\BaseAuthService;

use function App\Helpers\settings;

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
            return ['status' => false, 'message' => 'Failed to add review'];
        }
        return ['status' => true, "data" => $review];
    }

    public function createOrder($data)
    {

        //1) get the restaurant status
        $restaurant = Restaurant::find($data['restaurant_id']);
        //2) check if the restaurant is closed
        if ($restaurant->status == RestaurantStatus::Closed->value) {
            return ['status' => false, 'message' => 'Sorry, this restaurant is closed now'];
        }

        // 3) create empty order 
        $cost = 0;
        $delivery_price = $restaurant->delivery_price;
        $order = request()->user()->orders()->create(
            [
                'restaurant_id' => $data['restaurant_id'],
                'note' => $data['note'],
                'address' => $data['address'],
                'status' => OrderStatus::Pending->value,
                'payment_method_id' => $data['payment_method_id'],
            ]
        );

        // 4) attach meals to the order
        foreach ($data['meals'] as $m) {
            $meal = Meal::find($m['meal_id']);
            $meal_data = [
                $m['meal_id'] => [
                    'quantity' => $m['quantity'],
                    'price' => $meal->price,
                    'note' => $m['note'] ?? ''
                ]
            ];

            $order->meals()->attach($meal_data);
            $cost += ($meal->price * $m['quantity']);
        }

        // 5) accept the order of the restaurant is open
        if ($cost < $restaurant->min_order_price) {
            // rollback then return error
            $order->meals()->detach();
            $order->delete();
            return ['status' => false, 'message' => 'The total price of the order must be greater than ' . $restaurant->min_order_price];
        }

        // 6) calculate the total 

        $total_price = $cost + $delivery_price;
        $commission_price = (settings()->commission / 100 * $cost); // 10% of the total meals price 
        $net = $total_price - $commission_price;

        // 7) update the order with the total price
        tap($order)->update([
            'cost' => $cost,
            'delivery_price' => $delivery_price,
            'total_price' => $total_price,
            'commission_price' => $commission_price,
            'net' => $net
        ])->load('meals');


        // 8) send notification to the restaurant
        //TODO: send notification to the restaurant


        //  9) return success response
        return ['status' => true, 'data' => $order];
    }
}
