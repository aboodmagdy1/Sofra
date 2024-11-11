<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\District;
use App\Models\Offer;
use App\Models\Setting;
use App\Services\Restaurant\RestaurantService;
use Illuminate\Http\Request;
use function App\Helpers\responseJson;

class GeneralController extends Controller
{

    public function __construct(private RestaurantService $service) {}
    public function cities()
    {
        $records = City::all();
        return responseJson(1, 'success', $records);
    }
    public function districts()
    {
        $records = District::query();
        if (request()->has('city_id')) {
            $records->where('city_id', request()->city_id);
        }
        $records = $records->get();
        return responseJson(1, 'success', $records);
    }

    public function restaurant_categories()
    {
        $records = Category::all();
        return responseJson(1, 'success', $records);
    }

    public function offers()
    {
        $records = Offer::all();
        responseJson(1, 'success', $records);
    }

    public function list_restaurants()
    {
        $district_id = request()->district_id;
        $name = request()->name;
        $response = $this->service->list($district_id, $name);
        return responseJson($response['status'], $response['message'], $response['data']);
    }

    public function show_restaurant($id)
    {
        $response = $this->service->show($id);
        return responseJson($response['status'], $response['message'], $response['data']);
    }

    public function settings()
    {
        $record = Setting::first();
        return responseJson(1, 'success', $record);
    }

    public function contact()
    {
        request()->validate((
            [
                'full_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
                'type' => 'required|in:complaint,suggestion,inquiry'
            ]
        ));
        $record = Contact::create(request()->all());
        return responseJson(1, 'success', $record);
    }
}
