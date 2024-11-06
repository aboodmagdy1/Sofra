<?php

namespace App\Services\Client;

use App\Http\Requests\Api\Client\RegisterRequest;
use App\Http\Requests\Api\Client\ResetPasswordRequest;
use App\Http\Requests\Api\Client\UpdateProfileRequest;
use App\Mail\ForgetPasswordMail;
use App\Repositories\Eloquent\ClientRepository;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use function App\Helpers\deleteImage;
use function App\Helpers\serviceResponse;
use function App\Helpers\uploadImage;

class ClientAuthService
{


    public function __construct(protected ClientRepository $repository) {}

    public function loginClient(array $credentials)
    {
        $client = $this->repository->findBy('email', $credentials['email']);;
        if ($client && Hash::check($credentials['password'], $client->password)) {
            $client->tokens()->delete();

            //device token
            $client->tokens()->where('name', 'mobile')->delete();
            $client->createToken('mobile');

            $api_token = $client->createToken('client-api')->plainTextToken; // api token

            return serviceResponse(1, 'success', [
                'client' => $client,
                'api_token' => $api_token
            ]);
        }
        return serviceResponse(0, 'invalid Credintials');
    }

    public function registerClient($data)
    {
        if (isset($data['image'])) {
            $data['image'] = uploadImage($data['image'], 'clients');
        }

        $client = $this->repository->create($data);

        $client->createToken('mobile');
        $api_token = $client->createToken('client-api')->plainTextToken;
        return serviceResponse(1, 'success', [
            'client' => $client,
            'api_token' => $api_token
        ]);
    }

    public function forgetPassword($data)
    {
        $client = $this->repository->findBy('email', $data['email']);
        if (!$client) {
            return serviceResponse(0, 'invalid email address');
        }
        // 1) generate random code
        $code = rand(1111, 9999);
        $client->reset_code = $code;
        $client =  $this->repository->update($client->id, ['reset_code' => $code]);

        // 2) send the email to client
        try {
            Mail::to($client->email)->send(new ForgetPasswordMail($code));
        } catch (Exception $e) {
            return serviceResponse(0, 'error in sending email :' . $e->getMessage());
        }
        // 3) return success message
        return serviceResponse(1, 'please check you email', ['reset_code' => $code]);
    }


    public function resetPassword($data)
    {

        $client = $this->repository->findBy('email', $data['email']);
        if (!$client) {
            return serviceResponse(0, 'invalid email address');
        }

        if (!$client->reset_code  == $data['reset_code']) {
            return serviceResponse(0, 'invalid reset code');
        }
        $this->repository->update($client->id, ["password" => $data['password'], "reset_code" => null]);

        return serviceResponse(1, 'password changed successfully');
    }

    public function logout($request)
    {
        $request->user()->tokens()->delete();
        return serviceResponse(1, 'logged out successfully');
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = uploadImage($validated['image'], 'clients');
            deleteImage($request->user()->image);
        }
        $this->repository->update($request->user()->id, $validated);
        return serviceResponse(1, 'profile updated successfully');
    }
}
