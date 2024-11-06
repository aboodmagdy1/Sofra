<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\LoginRequest;
use App\Http\Requests\Api\Client\RegisterRequest;
use App\Http\Requests\Api\Client\ResetPasswordRequest;
use App\Http\Requests\Api\Client\UpdateProfileRequest;
use App\Services\Client\ClientAuthService;

use Illuminate\Http\Request;


class AuthController extends Controller
{

    public function __construct(protected ClientAuthService $service) {}


    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->loginClient($validated);
        return response()->json($result);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->registerClient($validated);
        return response()->json($result);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email'
        ]);
        $result = $this->service->forgetPassword($request->all());
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
    public function updateProfile(UpdateProfileRequest $request)
    {
        $result = $this->service->updateProfile($request);
        return response()->json($result);
    }
}
