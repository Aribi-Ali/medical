<?php

namespace App\Services;

use App\Http\Requests\PharmacyRequest;
use App\Http\Resources\PharmacyResource;
use App\Models\Pharmacy;
use App\Models\WorkingSchedule;
use Illuminate\Support\Facades\Auth;

class PharmacyService
{

    public function getPharmacies()
    {
        // Retrieve pharmacies associated with the PharmacistDetails
        $pharmacies = Pharmacy::all();
        return PharmacyResource::collection($pharmacies);
    }

    public function showSearchPage($city, $isOpen)
    {
        // Fetch pharmacies based on the search criteria
        $pharmacies = $this->findPharmacies($city, $isOpen);

        return $pharmacies;
    }

    public function createPharmacy(PharmacyRequest $request)
    {
        $pharmacy = Pharmacy::create([
            "pharmacist_details_id" => Auth::id(),
            "name" => $request->get("name"),
            "city" => $request->get("city"),
            "address" => $request->get("address"),
        ]);

        // Check if working schedules are provided
        if ($request->has('timeSlots')) {
            // Insert new working schedules
            foreach ($request->input('timeSlots') as $schedule) {
                WorkingSchedule::create([
                    'pharmacy_id' => $pharmacy->id,
                    'day' => $schedule['dayOfWeek'],
                    'open_time' => $schedule['openTime'],
                    'close_time' => $schedule['closeTime'],
                ]);
            }
        }
    }

    public function getPharmacyDetails($pharmacyId)
    {
        $pharmacy = Pharmacy::with('workingSchedules')->find($pharmacyId)->first();
        return new PharmacyResource($pharmacy);
    }

    public function toggleStatus($pharmacyId)
    {
        $pharmacy = $this->getPharmacyDetails($pharmacyId);
        if (!$pharmacy) {
            abort(404, "Pharmacy details not found.");
        }
        $pharmacy->update(["status" => !$pharmacy->status]);
        return new PharmacyResource($pharmacy);
    }

    public function deletePharmacy(Pharmacy $pharmacy)
    {
        if ($pharmacy->pharmacist_details_id !== Auth::id()) {
            abort(403, "You are not authorized to delete this pharmacy.");
        }

        $pharmacistPharmacies = Pharmacy::where('pharmacist_details_id', Auth::id())->count();

        if ($pharmacistPharmacies <= 1) {
            abort(400, "You must own at least one pharmacy.");
        }

        $pharmacy->delete();
    }

    // Helper function to find pharmacies
    private function findPharmacies($city, $isOpen)
    {
        // Get the current day and time
        $currentDay = now()->format('l'); // e.g., "Monday"
        $currentTime = now()->format('H:i:s'); // e.g., "14:30:00"

        // Start with all pharmacies
        $query = Pharmacy::with('workingSchedules');
        // Filter by city if provided
        if ($city) {
            $query->where('city', $city);
        }

        // Get the pharmacies
        $pharmacies = $query->get();

        // Filter pharmacies based on open status if requested
        if ($isOpen) {
            $pharmacies = $pharmacies->filter(function ($pharmacy) use ($currentDay, $currentTime) {
                // Find the working schedule for the current day
                $schedule = $pharmacy->workingSchedules->firstWhere('day', strtoupper($currentDay));

                // Check if the pharmacy is open
                if ($schedule) {
                    return $currentTime >= $schedule->open_time && $currentTime <= $schedule->close_time;
                }

                return false; // No schedule for the current day
            });
        }

        return $pharmacies;
    }
}