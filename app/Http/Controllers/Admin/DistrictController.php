<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Services\Admin\DistrictService;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function __construct(private DistrictService $service) {}

    public function index()
    {
        $records = $this->service->all();
        return view('districts.index', compact('records'));
    }


    public function create()
    {
        return view('districts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'city_id' => 'required|exists:cities,id'
        ]);

        $result = $this->service->create($request->only(['name', 'city_id']));
        if ($result['status']) {
            return redirect(route('admin.districts.index'))->with('success', "record Created successfuly ");
        }
        return back()->with('error', $result['message']);
    }
    public function edit(District $district)
    {
        return view('districts.edit', ['record' => $district]);
    }


    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => 'required|string',
            'city_id' => 'required|exists:cities,id'
        ]);

        $result = $this->service->update($district, $request->only(['name', 'city_id']));
        if ($result['status']) {
            return redirect(route('admin.districts.index'))->with('success', "record updated successfuly ");
        }
        return back()->with('error', $result['message']);
    }


    public function destroy(string $id)
    {


        $result = $this->service->delete($id);
        record:
        if ($result['status']) {
            return redirect(route('admin.districts.index'))->with('success', "record Deleted successfuly ");
        }
        return back()->with('error', $result['message']);
    }
}
