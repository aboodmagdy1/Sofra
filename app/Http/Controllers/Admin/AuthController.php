<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Services\Admin\AdminAuthService;

class AuthController extends Controller
{

    public function __construct(private AdminAuthService $service) {}

    public function login()
    {
        return view('admin.auth.login');
    }
    public function loginSubmit(LoginRequest $request)
    {

        $result = $this->service->login($request);
        if ($result['status'] == 'success') {
            return redirect()->route('admin.dashboard')->with('success', 'Logged In successfyly');
        }
        return back()->with('error', 'invalid credentals or account is not active');
    }

    public function logout()
    {
        $this->service->logout();
        return redirect()->route('admin.login')->with('success', 'Logged Out successfyly');
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }
    public function submitForgotPassword()
    {
        $result = $this->service->forgetPassword();
        if ($result['status']) {
            return redirect()->route('admin.resetPassword')
                ->with('success', 'Email sent successfully with reset code');
        }
        return back()->with('error', $result['message']);
    }
    public function resetPassword()
    {
        return view('admin.auth.reset-password');
    }
    public function submitResetPassword(ResetPasswordRequest $request)
    {
        $result = $this->service->resetPassword($request->validated());
        if ($result['status']) {
            return redirect()->route('admin.login')->with('success', 'Password Reseted successfully');
        }
        return back()->with('error', $result['message']);
    }

    public function profile()
    {
        return view('admin.auth.profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $result = $this->service->updateProfile($request->validated());
        if ($result['status']) {
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
        }
        return back()->with('error', $result['message']);
    }
}
