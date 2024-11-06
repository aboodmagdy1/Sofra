<?php

namespace App\Services\Restaurant;

use App\Mail\ForgetPasswordMail;
use App\Repositories\Eloquent\RestaurantRepository;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use function App\Helpers\deleteImage;
use function App\Helpers\serviceResponse;
use function App\Helpers\uploadImage;

class RestaurantAuthServuce
{

    public function __construct(private RestaurantRepository $repository) {}

    public function login(array $credentials)
    {
        $restaurant = $this->repository->filter(['email' => $credentials['email']])->first();
        if ($restaurant && Hash::check($credentials['password'], $restaurant->password)) {
            $restaurant->tokens()->delete();

            //device token
            $restaurant->tokens()->where('name', 'mobile')->delete();
            $restaurant->createToken('mobile');

            $api_token = $restaurant->createToken('restaurant-api')->plainTextToken; // api token

            return serviceResponse(1, 'login successful', ['restaurant' => $restaurant, 'api_token' => $api_token]);
        }

        return serviceResponse(0, 'invalid credentials');
    }

    public function register(array $data)
    {
        // 1) image upload 
        // dd($validated['image']->extension());
        $imagePath =   uploadImage($data['image'], 'restaurants');
        $data['image'] = $imagePath;

        // 2) create restaurant
        $restaurant = $this->repository->create($data);

        $restaurant->createToken('mobile');
        $api_token = $restaurant->createToken('restaurant-api')->plainTextToken;

        if ($restaurant) {
            return serviceResponse(1, 'register successful', ['restaurant' => $restaurant, 'api_token' => $api_token]);
        }

        return serviceResponse(0, 'error in creating restaurant');
    }

    public function forgetPassword(array $data)
    {

        $restaurant = $this->repository->findBy('email', $data['email']);
        if (!$restaurant) {
            return serviceResponse(0, 'invalid email address');
        }
        // 1) generate random code
        $code = rand(1111, 9999);
        $restaurant->reset_code = $code;
        $restaurant->save();

        // 2) send the email to restaurant
        try {
            Mail::to($restaurant->email)->send(new ForgetPasswordMail($code));
        } catch (Exception $e) {
            return serviceResponse(0, 'error in sending email :' . $e->getMessage());
        }
        // 3) return success message
        return serviceResponse(1, 'please check your email', ['reset_code' => $code]);
    }


    public function resetPassword(array $data)
    {
        $restaurant = $this->repository->findBy('email', $data['email'])->first();
        if (!$restaurant) {
            return serviceResponse(0, 'invalid email address');
        }

        if (!$restaurant->reset_code  == $data['reset_code']) {
            return serviceResponse(0, 'invalid reset code');
        }

        $restaurant->password = $data['password'];
        $restaurant->reset_code = null;
        $this->repository->update($restaurant->id, $restaurant->toArray());

        return serviceResponse(1, 'password changed successfully');
    }

    public function logout($request)
    {
        $request->user()->tokens()->delete();
        return serviceResponse(1, 'logged out successfully');
    }



    public function updateProfile($request)
    {
        $validated = $request->validated();
        $restaurant = $request->user();
        // 1) check if the new image is uploaded
        if ($request->hasFile('image')) {
            // 1.1) delete the old image
            deleteImage($restaurant->image,);
            // 1.2) upload the new image
            $imagePath =   uploadImage($validated['image'], 'restaurants');
            $validated['image'] = $imagePath;
        }
        // 2) update the restaurant
        $restaurant =   $this->repository->update($restaurant->id, $validated);

        return serviceResponse(1, 'logged out successfully', ['restaurant' => $restaurant]);
    }
}
