<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(private CityService $service) {}

    public function index()
    {
        $records = $this->service->index();
        return view('cities.index', compact('records'));
    }
    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|string'
        ]);
        // create
        $result = $this->service->create(['name' => $request->input('name')]);
        if ($result['status']) {
            return redirect(route('admin.cities.index'))->with('success', 'City Created Successfuly');
        }

        return back()->with('error', 'Error Creating City');
    }

    public function edit(City $city)
    {
        return view('cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        // 1) validate
        $request->validate([
            'name' => 'required|string'
        ]);
        // 2) update
        $result = $this->service->update(['name' => $request->input('name')],  $city);
        if ($result['status']) {
            return redirect(route('admin.cities.index'));
        }

        return back()->with($result['message']);
    }

    public function destroy(City $city)
    {
        $result = $this->service->delete($city);
        if ($result['status']) {
            return redirect(route('admin.cities.index'))->with('success', 'City deleted');
        }
        return back()->with('error', $result['message']);
    }
}
