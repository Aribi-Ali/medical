<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocotorRegisterRequest;
use App\Services\DoctorAuthService;
use Illuminate\Http\Request;

class DoctorAuthController extends Controller
{
    protected $doctorAuthService;

    public function __construct(DoctorAuthService $doctorAuthService) {
        $this->doctorAuthService = $doctorAuthService;
    }

    public function register(DocotorRegisterRequest $request) {
        
        $this->doctorAuthService->register($request);
        // Redirect with a success message
        return redirect()->route('doctor.schedules')
            ->with('success', 'Registration successful.');
    }
}