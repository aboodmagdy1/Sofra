<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Offer;
use Illuminate\Http\Request;
use function App\Helpers\responseJson;

class GeneralController extends Controller
{
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
}
