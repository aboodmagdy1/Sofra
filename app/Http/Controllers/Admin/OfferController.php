<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Services\Admin\DashBoardOfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function __construct(private DashBoardOfferService $service) {}


    public function index()
    {
        //TODO : validation on restaurant name 
        request()->validate([
            'restaurant_name' => 'nullable|string|exists:restaurants,name'
        ], [
            'restaurant_name.exists' => 'restaurant name not found'
        ]);
        // offers filterd with restaurant name
        if (request()->filled('restaurant_name')) {
            $restaurant = Restaurant::where('name', 'like', '%' . request('restaurant_name') . '%')->first();

            // get offers based on restaurant id
            $records = $this->service->filterd(['restaurant_id' => $restaurant->id]);
        } else {
            $records = $this->service->all();
        }

        return view('offers.index', compact('records'));
    }

    public function destroy(string $id)
    {
        $result = $this->service->delete($id);

        if ($result['status']) {
            return redirect()->route('admin.offers.index')->with('success', 'record deleted successfully');
        }
        return back()->with('error', $result['message']);
    }
}
