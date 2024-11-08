<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Restaurant\CreateOfferRequest;
use App\Http\Requests\Api\Restaurant\updateOfferRequest;
use App\Services\Restaurant\OfferService;

use function App\Helpers\responseJson;

class OfferController extends Controller
{

    public function __construct(protected OfferService $service) {}
    public function index()
    {
        $result = $this->service->show();
        if ($result['status']) {
            return responseJson(1, 'data retrived successfuly', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function store(CreateOfferRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->create($validated, $request->user()->id);
        if ($result['status']) {
            return responseJson(1, 'Offer Created', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function update(updateOfferRequest $request, string $id)
    {
        $validated = $request->validated();
        $result = $this->service->update($validated, $id);
        if ($result['status']) {
            return responseJson(1, 'offer updated');
        }
        return responseJson(0, $result['message']);
    }

    public function delete(string $id)
    {
        $result = $this->service->delete($id);

        if ($result['status']) {
            return responseJson(1, 'offer deleted');
        }
        return responseJson(0, $result['message']);
    }
}
