<?php

namespace App\Services\Restaurant;

use function App\Helpers\deleteImage;
use function App\Helpers\uploadImage;
use App\Models\Meal;
use App\Repositories\Eloquent\MealRepository;
use Illuminate\Support\Facades\Storage;

class MealService
{


    public function __construct(protected MealRepository $repository) {}


    public function show($restaurant_id)
    {
        $records = $this->repository->filter(['restaurant_id' => $restaurant_id]);
        if ($records) {
            return ['status' => true, "data" => $records];
        }
        return ['status' => false, "message" => "No records found"];
    }

    public function create($data, $restaurant_id)
    {
        $data['restaurant_id'] = $restaurant_id;

        // upload image
        $data['image'] = uploadImage($data['image'], 'meals');
        $record = $this->repository->create($data);
        if ($record) {
            return ['status' => true, "data" => $record];
        }
        return ['status' => false, "message" => "Failed to create record"];
    }

    public function update($data, $id)
    {
        $record = Meal::find($id);
        if (!$record) {
            return ['status' => false, "message" => "No records found"];
        }
        if (isset($data['image'])) {
            $data['image'] = uploadImage($data['image'], 'meals');
            deleteImage($record->image); // delete old image
        }

        tap($record)->update($data);

        return ['status' => true, "data" => $record];
    }

    public function delete(string $id)
    {
        $record = Meal::find($id);

        if (!$record) {
            return ['status' => false, "message" => "No record found"];
        }

        deleteImage($record->image); // delete image
        $record->delete();
        return ['status' => false, "message" => "Record deleted successfully"];
    }
}
