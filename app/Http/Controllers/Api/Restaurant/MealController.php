<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Restaurant\CreateMealRequest;
use App\Http\Requests\Api\Restaurant\UpdateMealRequest;
use App\Services\Restaurant\MealService;
use function App\Helpers\responseJson;


class MealController extends Controller
{
    public function __construct(protected MealService $service) {}

    public function index()
    {
        $result = $this->service->show(request()->user()->id);

        if ($result['status']) {
            return responseJson(1, 'Meals retrieved successfully', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function store(CreateMealRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->create($validated, $request->user()->id);
        if ($result['status']) {
            return responseJson(1, 'Meals created successfully', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function update(UpdateMealRequest $request, string $id)
    {
        $validated = $request->validated();
        $result = $this->service->update($validated, $id);
        if ($result['status']) {
            return responseJson(1, 'Meal updated successfully', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function delete(string $id)
    {
        $result = $this->service->delete($id);
        if ($result['status']) {
            return responseJson(1,  $result['message']);
        }
        return responseJson(0, $result['message']);
    }
}
