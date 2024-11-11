<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\CreateOrderRequest;
use App\Services\OrderService;
use function App\Helpers\responseJson;
use App\Models\Order;


class OrderController extends Controller
{

    public function __construct(private OrderService $service) {}


    public function createOrder(CreateOrderRequest $request)
    {
        $data = $request->validated();
        $result = $this->service->create($data);
        if ($result['status']) {
            return responseJson(1, 'Order created successfully', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function clientCurrentOrders()
    {
        $result = $this->service->currentClientOrders();
        if ($result['status']) {
            return responseJson(1, 'Orders retrieved successfully', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function clientPreviousOrders()
    {
        $result = $this->service->previousClientOrders();
        if ($result['status']) {
            return responseJson(1, $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function showOrder(string $id)
    {
        $result = $this->service->show($id);
        if ($result['status']) {
            return responseJson(1, 'sccess', $result['data']);
        }
        return responseJson(0, 'no order with this id  ');
    }

    public function restCurrentOrders()
    {
        $result = $this->service->restCurrentOrders();
        if ($result['status']) {
            return responseJson(1, 'success', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function restNewOrders()
    {
        $result = $this->service->restNewOrders();
        if ($result['status']) {
            return responseJson(1, 'success', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function restPrevOrders()
    {
        $result = $this->service->restPreviousOrders();
        if ($result['status']) {
            return responseJson(1, 'success', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function commission()
    {
        $result = $this->service->calculateCommission();
        if ($result['status']) {
            return responseJson(1, 'success', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function cancelOrder(string $id)
    {
        $result = $this->service->cancel($id);
        if ($result['status']) {
            return responseJson(1, $result['message']);
        }
        return responseJson(0, $result['message']);
    }
    public function receiveOrder(string $id)
    {
        $result = $this->service->receive($id);
        if ($result['status']) {
            return responseJson(1, $result['message']);
        }
        return responseJson(0, $result['message']);
    }
    public function acceptOrder(string $id)
    {
        $result = $this->service->accept($id);
        if ($result['status']) {
            return responseJson(1, $result['message']);
        }
        return responseJson(0, $result['message']);
    }
    public function rejectOrder(string $id)
    {
        $result = $this->service->reject($id);
        if ($result['status']) {
            return responseJson(1, $result['message']);
        }
        return responseJson(0, $result['message']);
    }
}
