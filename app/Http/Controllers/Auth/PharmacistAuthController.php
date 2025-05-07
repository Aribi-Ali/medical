<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\PharmacistAuthService;

class PharmacistAuthController extends Controller
{
    protected $pharmacistAuthService;

    public function __construct(PharmacistAuthService $pharmacistAuthService){
        $this->pharmacistAuthService = $pharmacistAuthService;
    }

    public function register(RegisterRequest $request){
        $this->pharmacistAuthService->register($request);
        // Redirect with a success message
        return redirect()->route('pharmacies.index')
            ->with('success', 'Registration successful.');
    }
}
