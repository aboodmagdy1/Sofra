<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\LoginRequest;
use App\Http\Requests\Api\Client\RegisterRequest;
use App\Http\Requests\Api\Client\ResetPasswordRequest;
use App\Http\Requests\Api\Client\UpdateProfileRequest;
use App\Services\Client\ClientService;
use Illuminate\Http\Request;
use function App\Helpers\responseJson;


class AuthController extends Controller
{

    public function __construct(protected ClientService $service) {}


    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->login($validated);

        if ($result['status']) {
            return responseJson(1, 'success', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->register($validated);
        if ($result['status']) {
            return responseJson(1, 'success', $result['data']);
        }
        return responseJson(0, $result['message']);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email'
        ]);
        $result = $this->service->forgetPassword($request->all());
        if ($result['status']) {
            return responseJson(1, 'success', $result['message']);
        }
        return responseJson(0, $result['message']);
    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->resetPassword($validated);
        if ($result['status']) {
            return responseJson(1, 'success', $result['message']);
        }
        return responseJson(0, $result['message']);
    }

    public function logout(Request $request)
    {
        $result = $this->service->logout();
        if ($result['status']) {
            return responseJson(1, 'success', $result['message']);
        }
        return responseJson(0, $result['message']);
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        $result = $this->service->updateProfile($validated);
        if ($result['status']) {
            return responseJson(1, 'success', $result['message']);
        }
        return responseJson(0, $result['message']);
    }
}
