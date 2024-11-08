<?php

namespace App\Services\Restaurant;

use App\Repositories\Eloquent\OfferRepository;

use function App\Helpers\deleteImage;
use function App\Helpers\uploadImage;

class OfferService
{

    public function __construct(private OfferRepository $repository) {}

    public function show()
    {
        $records = $this->repository->filter(['restaurant_id' => request()->user()->id]);
        if ($records) {
            return ['status' => true, 'data' => $records];
        }
        return ['status' => false, 'message' => 'no offers found'];
    }

    public function create($data, $restaurant_id)
    {
        $data['restaurant_id'] = $restaurant_id;

        // upload image
        $data['image'] = uploadImage($data['image'], 'offers');

        $record = $this->repository->create($data);
        if ($record) {
            return ['status' => true, 'data' => $record];
        }
        return ['status' => false, 'message' => 'Failed to create offer'];
    }

    public function update($data, $restaurant_id)
    {

        $record = $this->repository->find($restaurant_id);

        if (!$record) {
            return ["status" => 0, "message" => 'offer not found'];
        }

        if (isset($data['image'])) {
            $data['image'] = uploadImage($data['image'], 'offers');
            deleteImage($record->image); // delete old image
        }

        tap($record)->update($data);

        return ['status' => true, 'message' => 'offer updated succefuly'];
    }

    public function delete($restaurant_id)
    {
        $offer = $this->repository->find($restaurant_id);

        if (!$offer) {
            return ["status" => 0, "message" => 'offer not found'];
        }

        deleteImage($offer->image); // delete image
        $offer->delete();

        return ['status' => true, 'message' => 'offer deleted succefuly'];
    }
}
