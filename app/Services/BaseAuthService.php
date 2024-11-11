<?php

namespace App\Services;

use App\Mail\ForgetPasswordMail;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use function App\Helpers\deleteImage;
use function App\Helpers\uploadImage;

class BaseAuthService
{
    public function __construct(private $repository) {}

    public function login(array $credentials)
    {
        $record = $this->repository->filter(['email' => $credentials['email']])->first();
        if ($record && Hash::check($credentials['password'], $record->password)) {
            //device token
            $record->tokens()->where('name', 'mobile')->delete();
            $record->createToken('mobile');

            $api_token = $record->createToken('api')->plainTextToken; // api token

            return  ["data" => ["record" => $record,  "api_token" => $api_token], 'status' => true];
        }

        return ['status' => false, 'message' => 'invalid credentials'];
    }

    public function register(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = uploadImage($data['image'], 'clients');
        }

        $newRecord = $this->repository->create($data);
        if (!$newRecord) {
            return ['status' => false, 'message' => 'error in creating record'];
        }
        $newRecord->createToken('mobile');
        $api_token = $newRecord->createToken('api')->plainTextToken;

        // for restaurant category
        if (isset($data['category_ids'])) {
            $newRecord->categories()->attach($data['category_ids']);
        }
        return  ["data" => ["record" => $newRecord,  "api_token" => $api_token], 'status' => true];
    }

    public function forgetPassword($data)
    {
        $recipent = $this->repository->findBy('email', $data['email']);
        if (!$recipent) {
            return ["status" => false, "message" => "invalid email address"];
        }

        // 1) generate random code
        $code = rand(1111, 9999);
        $recipent->reset_code = $code;
        $recipent->save();

        // 2) send the email to recipent
        try {
            Mail::to($recipent->email)->send(new ForgetPasswordMail($code));
        } catch (Exception $e) {
            return ["status" => false, "message" => $e->getMessage()];
        }
        // 3) return success message
        return ["status" => true, "data" => ["reset_code" => $code]];
    }

    public function resetPassword(array $data)
    {
        $restaurant = $this->repository->findBy('email', $data['email']);
        if (!$restaurant) {
            return ['status' => false, "message" => "invalid email address"];
        }

        if (!$restaurant->reset_code  == $data['reset_code']) {
            return ['status' => false, "message" => "invalid reset code"];
        }

        $restaurant->password = $data['password'];
        $restaurant->reset_code = null;
        $restaurant->save();

        return ['status' => true, "message" => "password changed successfully"];
    }

    public function logout()
    {
        request()->user()->tokens()->delete();
        return ['status' => true, 'message' => 'logged out successfully'];
    }
    public function updateProfile($validated)
    {;
        $restaurant = request()->user();
        // 1) check if the new image is uploaded
        if (request()->hasFile('image')) {
            // 1.1) delete the old image
            deleteImage($restaurant->image,);
            // 1.2) upload the new image
            $validated['image'] = uploadImage($validated['image'], 'restaurants');
        }
        // 2) update the restaurant
        tap($restaurant)->update($validated);

        return ['status' => true, 'message' => 'profile updated successfully', 'data' => $restaurant];
    }
}



// if status true then there is data 