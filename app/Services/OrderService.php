<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\RestaurantStatus;
use App\Models\Commision;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Restaurant;
use App\Repositories\Eloquent\OrderRepository;
use function App\Helpers\settings;

class OrderService
{
    public function __construct(private OrderRepository $repository) {}

    public function create($data)
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
                'status' => OrderStatus::PENDING->value,
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

    public function currentClientOrders(): array
    {
        $records = Order::ofStatus([OrderStatus::PENDING->value, OrderStatus::ACCEPTED->value])->where('client_id', request()->user()->id)->get();
        return ['status' => true, 'data' => $records];
    }

    public function previousClientOrders()
    {
        $records = Order::ofStatus([OrderStatus::REJECTED->value, OrderStatus::DELIVERED->value, OrderStatus::CANCELED->value])->where('client_id', request()->user()->id)->get();
        return ['status' => true, 'data' => $records];
    }

    public function show(string $id)
    {
        $record = Order::where('id', $id)->first();
        if ($record) {
            return ['status' => true, 'data' => $record];
        }

        return ['status' => false];
    }

    public function restNewOrders()
    {
        $orders =   Order::ofStatus([OrderStatus::PENDING->value])
            ->where('restaurant_id', request()->user()->id)
            ->get();

        return ['status' => true, 'data' => $orders];
    }
    public function restCurrentOrders()
    {
        $orders =   Order::ofStatus([OrderStatus::ACCEPTED->value])
            ->where('restaurant_id', request()->user()->id)
            ->get();

        return ['status' => true, 'data' => $orders];
    }
    public function restPreviousOrders()
    {
        $orders =   Order::ofStatus([OrderStatus::REJECTED->value, OrderStatus::DELIVERED->value, OrderStatus::CANCELED->value])
            ->where('restaurant_id', request()->user()->id)
            ->get();

        return ['status' => true, 'data' => $orders];
    }
    public function  calculateCommission()
    {
        // get the total price of the orders
        $orders = request()->user()->orders()->where('status', OrderStatus::DELIVERED->value)->get();
        $total = $orders->sum('total_price');
        $net = $orders->sum('net');
        $app_commission = $orders->sum('commission_price');
        $rest_payed_commission = Commision::where('restaurant_id', request()->user()->id)->sum('amount');
        return ['status' => true, 'data' => [
            'مبيعات المطعم' => $total,
            'الصافي' => $net,
            'العمولة' => $app_commission,
            'العمولة المدفوعة' => +$rest_payed_commission,
            'العمولة المستحقة' => $app_commission - $rest_payed_commission,
        ]];
    }

    public function cancel($id)
    {
        $order = $this->repository->filter(['client_id' => request()->user()->id])->find($id);
        if ($order) {
            $order->update(['status' => OrderStatus::CANCELED->value]);
            return ['status' => true, 'message' => 'Order canceled successfully'];
        }
        return ['status' => false, 'message' => 'Order not found'];
    }
    public function reject($id)
    {
        $order = $this->repository->find($id);
        if ($order) {
            $order->update(['status' => OrderStatus::REJECTED->value]);
            return ['status' => true, 'message' => 'Order rejected successfully'];
        }
        return ['status' => false, 'message' => 'Order not found'];
    }
    public function receive($id)
    {
        $order = $this->repository->find($id);
        if ($order) {
            $order->update(['status' => OrderStatus::DELIVERED->value]);
            return ['status' => true, 'message' => 'Order deliverd successfully'];
        }
        return ['status' => false, 'message' => 'Order not found'];
    }
    public function accept($id)
    {
        $order = $this->repository->find($id);
        if ($order) {
            $order->update(['status' => OrderStatus::ACCEPTED->value]);
            return ['status' => true, 'message' => 'Order accepted successfully'];
        }
        return ['status' => false, 'message' => 'Order not found'];
    }
}
