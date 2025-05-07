<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(RegisterRequest $request)
    {
        // Create user object
        $user = User::create([
            "name" => $request->get('name'),
            "email" => $request->get('email'),
            "phone_number" => $request->get('phone_number'),
            "password" => Hash::make($request->get('password')),
        ]);
        // Authenticate the user
        auth()->login($user);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }
        return Auth::user();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
