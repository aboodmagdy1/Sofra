<?php

namespace App\Services\Restaurant;

use function App\Helpers\deleteImage;
use function App\Helpers\serviceResponse;
use function App\Helpers\uploadImage;
use App\Models\Meal;
use App\Repositories\Eloquent\MealRepository;
use Illuminate\Support\Facades\Storage;

class MealService
{


    public function __construct(protected MealRepository $repository) {}


    public function showMeals($restaurant_id)
    {
        $meals = $this->repository->filter(['restaurant_id' => $restaurant_id]);
        return serviceResponse(1, 'meals retrieved succefuly', ['meals' => $meals]);
    }

    public function createMeal($data, $restaurant_id)
    {
        $data['restaurant_id'] = $restaurant_id;

        // upload image
        $data['image'] = uploadImage($data['image'], 'meals');
        $meal = $this->repository->create($data);
        return serviceResponse(1, 'meal created succefuly', ['meal' => $meal]);
    }

    public function updateMeal($data, $id)
    {
        $meal = Meal::findOrFail($id);
        if (!$meal) {
            return serviceResponse(0, 'meal not found');
        }
        if (isset($data['image'])) {
            $data['image'] = uploadImage($data['image'], 'meals');
            deleteImage($meal->image); // delete old image
        }

        tap($meal)->update($data);
        return serviceResponse(1, 'meal updated succefuly', ['meal' => $meal]);
    }

    public function deleteMeal(string $id)
    {
        $meal = Meal::findOrFail($id);

        if (!$meal) {
            return serviceResponse(0, 'meal not found');
        }

        deleteImage($meal->image); // delete image
        $this->repository->delete($id);

        return serviceResponse(1, 'meal deleted succefuly');
    }
}
