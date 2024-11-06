<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Restaurant\CreateMealRequest;
use App\Http\Requests\Api\Restaurant\UpdateMealRequest;
use App\Models\Meal;
use App\Repositories\Eloquent\MealRepository;
use App\Services\Restaurant\MealService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function App\Helpers\deleteImage;
use function App\Helpers\responseJson;
use function App\Helpers\uploadImage;

class MealController extends Controller
{
    public function __construct(protected MealService $service) {}

    public function index()
    {
        $result = $this->service->showMeals(request()->user()->id);
        return response()->json($result);
    }

    public function store(CreateMealRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->createMeal($validated, $request->user()->id);
        return response()->json($result);
    }

    public function update(UpdateMealRequest $request, string $id)
    {
        $validated = $request->validated();
        $result = $this->service->updateMeal($validated, $id);
        return response()->json($result);
    }

    public function delete(string $id)
    {
        $result = $this->service->deleteMeal($id);
        return response()->json($result);
    }
}
