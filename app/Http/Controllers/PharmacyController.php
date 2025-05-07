<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyRequest;
use App\Http\Requests\PharmacyUpdateRequest;
use App\Models\Pharmacy;
use App\Services\PharmacyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    protected $pharmacyService;

    public function __construct(PharmacyService $pharmacyService) {
        $this->pharmacyService = $pharmacyService;
    }

    public function index() {
        $pharmacies = $this->pharmacyService->getPharmacies();
        return view("components.pharmacist.pharmacies", compact("pharmacies"));
    }

    public function findPharmacies(Request $request) {
        $pharmacies = $this->pharmacyService->showSearchPage($request->get("city"), $request->get("isOpen"));
        return view("patients.pharmacies", compact("pharmacies"));
    }

    public function show(Pharmacy $pharmacy) {
        $pharmacy = $this->pharmacyService->getPharmacyDetails($pharmacy);
        return view("components.pharmacist.pharmacy-details", compact("pharmacy"));
    }

    public function create() {
        return view("components.pharmacist.manage-pharmacies");
    }

    public function store(PharmacyRequest $request) {
        $this->pharmacyService->createPharmacy($request);
        return redirect()->route('pharmacies.index')
            ->with('success', 'Pharmacy created successfully.');
    }

    public function toggleStatus(Pharmacy $pharmacy) {
        $this->pharmacyService->toggleStatus($pharmacy);
        return redirect()->route('dashboard');
    }

    public function delete(Pharmacy $pharmacy) {
        $this->pharmacyService->deletePharmacy($pharmacy);
        return redirect()->back()
            ->with('success', 'Pharmacy deleted successfully.');
    }
}