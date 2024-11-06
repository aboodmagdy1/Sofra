<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Restaurant\CreateOfferRequest;
use App\Http\Requests\Api\Restaurant\updateOfferRequest;
use App\Services\Restaurant\OfferService;


class OfferController extends Controller
{

    public function __construct(protected OfferService $service) {}
    public function index()
    {
        $result = $this->service->showOffers();
        return response()->json($result);
    }

    public function store(CreateOfferRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->createOffer($validated, $request->user()->id);
        return response()->json($result);
    }

    public function update(updateOfferRequest $request, string $id)
    {
        $validated = $request->validated();
        $result = $this->service->updateOffer($validated, $id);
        return response()->json($result);
    }

    public function delete(string $id)
    {
        $result = $this->service->deleteOffer($id);

        return response()->json($result);
    }
}
