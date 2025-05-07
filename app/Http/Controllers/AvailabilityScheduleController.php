<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailabilityScheduleRequest;
use App\Models\AvailabilitySchedule;
use App\Models\DoctorDetails;
use App\Services\AvailabilityScheduleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AvailabilityScheduleController extends Controller
{
    protected $availabilityService;

    public function __construct(AvailabilityScheduleService $availabilityService)
    {
        $this->availabilityService = $availabilityService;
    }

    public function index($doctorId){
        $allSchedules = $this->availabilityService->getAllAvailableSchedules($doctorId);
        return view('components.doctor.all-schedules',compact('allSchedules'));
    }

    public function getWorkingDays() {
        $workingDays = $this->availabilityService->getWorkingDays();
        return view('components.doctor.working-day', compact('workingDays'));
    }

    public function getAvailableSchedules($doctorId): JsonResponse {
        try {
            $schedules  = $this->availabilityService->getAvailableSchedules($doctorId);
            return response()->json($schedules);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create(){
        return view("components.doctor.manage-appointment");
    }

    public function store(AvailabilityScheduleRequest $request) {
        $this->availabilityService->setAvailability($request);
        return back()->with('success', 'Availability schedule created successfully.');
    }

    public function destroy(Request $request){
        $this->availabilityService->deleteAvailability($request->get("dayOfWeek"));
        return back()->with('success', 'Availability schedule deleted.');
    }

    public function resetAll(){
        $this->availabilityService->resetAll();
        return redirect()->back()
            ->with('success', 'All availability slots have been reset to available');
    }
}
