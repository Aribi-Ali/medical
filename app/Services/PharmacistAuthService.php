<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\PharmacistDetails;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PharmacistAuthService
{
    public function register(RegisterRequest $request)
    {
        // Create user object
        $user = User::create([
            "name" => $request->get('name'),
            "email" => $request->get('email'),
            "phone_number" => $request->get('phone_number'),
            "role" => "pharmacist",
            "password" => Hash::make($request->get('password')),
        ]);
        // Create pharmacist details
        PharmacistDetails::create([
            "user_id" => $user->id,
        ]);
        // Authenticate the user
        auth()->login($user);
    }
}
