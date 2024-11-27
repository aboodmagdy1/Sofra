<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardOrderService;
use Illuminate\Http\Request;

class DashboardOrderController extends Controller
{
    public function __construct(private  DashboardOrderService $service) {}

    public function index()
    {;
        $filters = is_array(request('status')) ? request('status') : [];
        $orders = $this->service->filterd(['status' => $filters]);
        return view('orders.index', ['records' => $orders, 'statuses' => OrderStatus::cases()]);
    }

    public function show(string $id)
    {
        $result = $this->service->find($id);
        if ($result['status']) {
            return view('orders.show', ['record' => $result['data']]);
        } else {
            return redirect()->route('orders.index')->with('error', $result['message']);
        }
    }
    public function print(string $id)
    {
        $result = $this->service->find($id);
        if ($result['status']) {
            return view('orders.print', ['record' => $result['data']]);
        } else {
            return redirect()->route('admin.orders.index')->with('error', $result['message']);
        }
    }
}
