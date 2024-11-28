<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardRestaurantService;
use Illuminate\Http\Request;

class DashboardRestaurantController extends Controller
{
    public function __construct(private DashboardRestaurantService $service) {}

    public function index(Request $request)
    {
        $records = $this->service->filterd($request->input('filters', []));
        return view('restaurants.index', compact('records'));
    }

    public function show(string $id)
    {
        $result  = $this->service->find($id);
        if (!$result['status']) {
            return redirect()->route('admin.restaurants.index')->with('error', $result['message']);
        }

        return view('restaurants.show', ['record' => $result['data']]);
    }
    public function update(string $id)
    {

        $result = $this->service->update($id, [
            'is_active' => request('is_active')
        ]);
        if (!$result['status']) {
            return redirect()->route('admin.restaurants.index')->with('error', $result['message']);
        }
        return redirect(route('admin.restaurants.index'))->with('success', 'Record updated successfully');
    }
    public function destroy(string $id)
    {
        $result  = $this->service->delete($id);
        if (!$result['status']) {
            return redirect()->route('admin.restaurants.index')->with('error', $result['message']);
        }

        return redirect(route('admin.restaurants.index'))->with('success', 'Record deleted successfully');
    }
}
