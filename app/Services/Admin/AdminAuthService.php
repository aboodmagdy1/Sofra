<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\LoginRequest;
use App\Mail\ForgetPasswordMail;
use App\Repositories\Eloquent\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\table;

class AdminAuthService
{
    public function __construct(private UserRepository $repository) {}
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {

            if (!Auth::user()->is_active) {
                Auth::logout();
                return ['status' => 'fail'];
            }

            return ['status' => 'success'];
        }
        return ['status' => 'fail'];
    }
    public function logout()
    {
        Auth::logout();
    }

    public function forgetPassword()
    {

        // 1) validate the email
        $data = request()->validate(['email' => 'required|email|exists:users,email']);

        if (!$data) {
            return ["status" => false, "message" => "invalid email address"];
        }

        $recipent = $this->repository->findBy('email', $data['email']);
        // to avoid duplicate entries
        if (DB::table('password_reset_tokens')->where('email', $recipent->email)->exists()) {
            DB::table('password_reset_tokens')->where('email', $recipent->email)->delete();
        }

        // 1) generate random code
        $code = rand(1111, 9999);
        DB::table('password_reset_tokens')->insert([
            'email' => $recipent->email,
            'token' => $code,
            'created_at' => now()
        ]);

        // 2) send the email to recipent
        try {
            Mail::to($recipent->email)->send(new ForgetPasswordMail($code));
        } catch (Exception $e) {
            return ["status" => false, "message" => $e->getMessage()];
        }
        // 3) return success message
        return ["status" => true, "message" => "email sent successfully"];
    }
    public function resetPassword(array $credentials)
    {
        // 1) validate email 
        $user = $this->repository->findBy('email', $credentials['email']);
        if (!$user) {
            return ['status' => false, "message" => "invalid email address"];
        }
        // 2) validate reset code
        $resetTokenRecord = DB::table('password_reset_tokens')->where('email', $user->email)->first();
        if (!$resetTokenRecord || $resetTokenRecord->token != $credentials['reset_code']) {
            return ['status' => false, "message" => "invalid reset code"];
        }

        // 3) update the password
        $user->password = Hash::make($credentials['password']);
        $user->save();

        // 4) delete the reset code
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();
        // 5) return success message
        return ['status' => true];
    }

    public function updateProfile(array $data)
    {
        // 1) get the user
        $user = request()->user();
        // 2) update password if changed
        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        } else {
            unset($data['password']);
            unset($data['confirm_password']);
        }
        // 3) update email if changed
        if (isset($data['email']) && $data['email'] != $user->email) {
            $user->email = $data['email'];
        } else {
            unset($data['email']);
        }
        // 4) update rest  of  field 
        $user->fill($data);
        $user->update();
        // 5) return success message
        return ['status' => true];
    }
}
