<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Restaurant\ResetPasswordRequest;
use App\Http\Requests\Api\Restaurant\RegisterRestaurantRequest;
use App\Http\Requests\Api\Restaurant\UpdateRestaurantProfileRequest;
use App\Services\Restaurant\RestaurantAuthServuce;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function __construct(protected RestaurantAuthServuce $service) {}
    public function login(Request $request)
    {
        $result = $this->service->login($request->only('email', 'password'));
        return response()->json($result);
    }

    public function register(RegisterRestaurantRequest $request)
    {
        $result = $this->service->register($request->validated());
        return response()->json($result);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:restaurants,email'
        ]);

        $result = $this->service->forgetPassword($request->only('email'));
        return response()->json($result);
    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->resetPassword($validated);
        return response()->json($result);
    }

    public function logout(Request $request)
    {
        $result = $this->service->logout($request);
        return response()->json($result);
    }

    public function updateProfile(UpdateRestaurantProfileRequest $request)
    {
        $result = $this->service->updateProfile($request);
        return response()->json($result);
    }
}
