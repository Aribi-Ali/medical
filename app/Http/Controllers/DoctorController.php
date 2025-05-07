<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DoctorService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function searchDoctors(Request $request)
    {
        // Validate the search input
        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);
        $query = $request->input('query');
        $doctors = $this->doctorService->searchDoctors($query);
        return view("patients.appointments", compact("doctors"));
    }
}