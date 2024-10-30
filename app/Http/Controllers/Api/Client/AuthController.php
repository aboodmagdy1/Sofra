<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\RegisterRequest;
use App\Http\Requests\Api\Client\ResetPasswordRequest;
use App\Http\Requests\Api\Client\UpdateProfileRequest;
use App\Mail\ForgetPasswordMail;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use function App\Helpers\responseJson;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $client = Client::where('email', $request->input('email'))->first();
        if ($client && Hash::check($request->input('password'), $client->password)) {
            $client->tokens()->delete();

            //device token
            $client->tokens()->where('name', 'mobile')->delete();
            $client->createToken('mobile');

            $api_token = $client->createToken('client-api')->plainTextToken; // api token

            return responseJson(1, 'success', [
                'client' => $client,
                'api_token' => $api_token
            ]);
        } else {
            return responseJson(0, 'invalid Credintials');
        }
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $client = Client::create($validated);

        $client->createToken('mobile');
        $api_token = $client->createToken('client-api')->plainTextToken;
        return responseJson(1, 'success', [
            'client' => $client,
            'api_token' => $api_token
        ]);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email'
        ]);

        $client = Client::where('email', $request->email)->first();
        if (!$client) {
            return responseJson(0, 'invalid email address');
        }
        // 1) generate random code
        $code = rand(1111, 9999);
        $client->reset_code = $code;
        $client->save();

        // 2) send the email to client
        try {
            Mail::to($client->email)->send(new ForgetPasswordMail($code));
        } catch (Exception $e) {
            return responseJson(0, 'error in sending email :' . $e->getMessage());
        }
        // 3) return success message
        return responseJson(1, 'please check you email', ['reset_code' => $code]);
    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        $client = Client::where('email', $request->email)->first();
        if (!$client) {
            return responseJson(0, 'invalid email address');
        }

        if (!$client->reset_code  == $validated['reset_code']) {
            return responseJson(0, 'invalid reset code');
        }

        $client->password = $validated['password'];
        $client->reset_code = null;
        $client->save();

        return responseJson(1, 'password changed successfully');
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return responseJson(1, 'logged out successfully');
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        $request->user()->update($validated);
        return responseJson(1, 'profile updated successfully', $request->user());
    }
}
