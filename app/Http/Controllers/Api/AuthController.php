<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function App\Helpers\responseJson;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $client = Client::where('email', $request->input('email'))->first();
        if ($client && Hash::check($request->input('password'), $client->password)) {
            $client->tokens()->delete();

            $token = $client->createToken('mobile')->plainTextToken;
            return responseJson(1, 'success', [
                'client' => $client,
                'token' => $token
            ]);
        } else {
            return responseJson(0, 'invalid Credintials');
        }
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($request->password);
        $client = Client::create($validated);
        $token = $client->createToken('mobile')->plainTextToken;
        return responseJson(1, 'success', [
            'client' => $client,
            'token' => $token
        ]);
    }
}
