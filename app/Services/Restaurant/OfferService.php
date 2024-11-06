<?php

namespace App\Services\Restaurant;

use App\Repositories\Eloquent\OfferRepository;

use function App\Helpers\deleteImage;
use function App\Helpers\serviceResponse;
use function App\Helpers\uploadImage;

class OfferService
{

    public function __construct(private OfferRepository $repository) {}

    public function showOffers()
    {
        $records = $this->repository->filter(['restaurant_id' => request()->user()->id]);
        return serviceResponse(1, 'success', $records);
    }

    public function createOffer($data, $restaurant_id)
    {
        $data['restaurant_id'] = $restaurant_id;

        // upload image
        $data['image'] = uploadImage($data['image'], 'offers');

        $record = $this->repository->create($data);
        return serviceResponse(1, 'offer created succefuly', ['offer' => $record]);
    }

    public function updateOffer($data, $restaurant_id)
    {

        $offer = $this->repository->find($restaurant_id);

        if (!$offer) {
            return serviceResponse(0, 'offer not found');
        }

        if (isset($data['image'])) {
            $data['image'] = uploadImage($data['image'], 'offers');
            deleteImage($offer->image); // delete old image
        }

        $this->repository->update($restaurant_id, $data);

        return serviceResponse(1, 'offer updated succefuly', ['offer' => $offer]);
    }

    public function deleteOffer($restaurant_id)
    {
        $offer = $this->repository->find($restaurant_id);

        if (!$offer) {
            return ["status" => 0, "message" => 'offer not found'];
        }

        deleteImage($offer->image); // delete image
        $offer->delete();

        return serviceResponse(1, 'offer deleted succefuly');
    }
}
