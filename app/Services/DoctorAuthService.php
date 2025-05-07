<?php

namespace App\Services;

use App\Http\Requests\DocotorRegisterRequest;
use App\Models\DoctorDetails;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorAuthService
{
    public function register(DocotorRegisterRequest $request)
    {
        // Create user object
        $user = User::create([
            "name" => $request->get('name'),
            "email" => $request->get('email'),
            "phone_number" => $request->get('phone_number'),
            "role" => "doctor",
            "password" => Hash::make($request->get('password')),
        ]);

        // Create doctor details
        DoctorDetails::create([
            "user_id" => $user->id,
            "specialization" => $request->get('specialization'),
            "address" => $request->get('address'),
            "wilaya" => $request->get('wilaya'),
            "bio" => $request->get('bio'),
        ]);

        // Authenticate the user
        auth()->login($user);
    }
}
