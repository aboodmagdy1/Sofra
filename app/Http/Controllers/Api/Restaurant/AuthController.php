<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Restaurant\ForgetPasswordRequest;
use App\Http\Requests\Api\Restaurant\ResetPasswordRequest;
use App\Http\Requests\Api\Restaurant\RegisterRestaurantRequest;
use App\Http\Requests\Api\Restaurant\UpdateRestaurantProfileRequest;
use App\Services\Restaurant\RestaurantAuthServuce;
use App\Services\Restaurant\RestaurantService;
use Illuminate\Http\Request;
use function App\Helpers\responseJson;


class AuthController extends Controller
{
    public function __construct(protected RestaurantService $service) {}
    public function login(Request $request)
    {
        $result = $this->service->login($request->only('email', 'password'));
        if ($result['status']) {
            return responseJson(1, 'success', $result['data']);
        }
        return responseJson(0, 'invalid Credintials');
    }

    public function register(RegisterRestaurantRequest $request)
    {
        $result = $this->service->register($request->validated());

        if ($result['status']) {
            return responseJson(1, 'success', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->forgetPassword($validated);
        if ($result['status']) {
            return responseJson(1, 'success', $result['data']);
        }
        return responseJson(0, $result['message']);
    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->resetPassword($validated);
        if ($result['status']) {
            return responseJson(1,  $result['message']);
        }
        return responseJson(0, $result['message']);
    }

    public function logout(Request $request)
    {
        $result = $this->service->logout();
        if ($result['status']) {
            return responseJson(1,  $result['message']);
        }
        return responseJson(0, $result['message']);
    }

    public function updateProfile(UpdateRestaurantProfileRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->updateProfile($validated);
        if ($result['status']) {
            return responseJson(1,  $result['message'], $result['data']);
        }
        return responseJson(0, $result['message']);
    }
}
