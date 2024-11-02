<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Restaurant\ResetPasswordRequest;
use App\Http\Requests\Api\Restaurant\RegisterRestaurantRequest;
use App\Http\Requests\Api\Restaurant\UpdateRestaurantProfileRequest;
use App\Mail\ForgetPasswordMail;
use App\Models\Restaurant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use function App\Helpers\responseJson;
use function App\Helpers\uploadImageLocaly;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $restaurant = Restaurant::where('email', $request->input('email'))->first();
        if ($restaurant && Hash::check($request->input('password'), $restaurant->password)) {
            $restaurant->tokens()->delete();

            //device token
            $restaurant->tokens()->where('name', 'mobile')->delete();
            $restaurant->createToken('mobile');

            $api_token = $restaurant->createToken('restaurant-api')->plainTextToken; // api token

            return responseJson(1, 'success', [
                'restaurant' => $restaurant,
                'api_token' => $api_token
            ]);
        } else {
            return responseJson(0, 'invalid Credintials');
        }
    }

    public function register(RegisterRestaurantRequest $request)
    {
        // 1)validation 
        $validated = $request->validated();
        // 2) image upload 
        // dd($validated['image']->extension());
        $imagePath =   uploadImageLocaly($validated['image'], 'restaurants');
        $validated['image'] = $imagePath;
        // 3) create restaurant
        $restaurant = Restaurant::create($validated);

        $restaurant->createToken('mobile');
        $api_token = $restaurant->createToken('restaurant-api')->plainTextToken;
        return responseJson(1, 'success', [
            'restaurant' => $restaurant,
            'api_token' => $api_token
        ]);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:restaurants,email'
        ]);

        $restaurant = Restaurant::where('email', $request->email)->first();
        if (!$restaurant) {
            return responseJson(0, 'invalid email address');
        }
        // 1) generate random code
        $code = rand(1111, 9999);
        $restaurant->reset_code = $code;
        $restaurant->save();

        // 2) send the email to restaurant
        try {
            Mail::to($restaurant->email)->send(new ForgetPasswordMail($code));
        } catch (Exception $e) {
            return responseJson(0, 'error in sending email :' . $e->getMessage());
        }
        // 3) return success message
        return responseJson(1, 'please check you email', ['reset_code' => $code]);
    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        $restaurant = Restaurant::where('email', $request->email)->first();
        if (!$restaurant) {
            return responseJson(0, 'invalid email address');
        }

        if (!$restaurant->reset_code  == $validated['reset_code']) {
            return responseJson(0, 'invalid reset code');
        }

        $restaurant->password = $validated['password'];
        $restaurant->reset_code = null;
        $restaurant->save();

        return responseJson(1, 'password changed successfully');
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return responseJson(1, 'logged out successfully');
    }



    public function updateProfile(UpdateRestaurantProfileRequest $request)
    {
        $validated = $request->validated();
        $restaurant = $request->user();
        // 1) check if the new image is uploaded
        if ($request->hasFile('image')) {
            // 1.1) delete the old image
            $this->deleteImage($restaurant->image);
            // 1.2) upload the new image
            $imagePath =   uploadImageLocaly($validated['image']);
            $validated['image'] = $imagePath;
        }
        // 2) update the restaurant
        $restaurant->update($validated);
        return responseJson(1, 'profile updated successfully', $restaurant);
    }

    protected function deleteImage($imagePath)
    {
        $fullPath = public_path($imagePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
