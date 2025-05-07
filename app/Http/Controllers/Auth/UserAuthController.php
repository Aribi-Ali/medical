<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController{
    protected $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function registerOptions() {
        return view('auth.register-options');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        $this->authService->register($request);
        // Redirect with a success message
        return redirect()->route('welcome')
            ->with('success', 'Registration successful.');
    }

    public function login(LoginRequest $request){
        $this->authService->login($request);
        return redirect()->intended($this->redirectTo(Auth::user()));
    }

    public function logout(Request $request){
        $this->authService->logout($request);
        return redirect()->route('welcome');
    }

    private function redirectTo($user)
    {
        return match ($user->role) {
            'pharmacist' => route('pharmacies.index'),
            'doctor' => route('doctor.schedules', ['doctorId' => $user->id]),
            'admin' => route('users.index'),
            default => route('welcome'),
        };
    }
}
