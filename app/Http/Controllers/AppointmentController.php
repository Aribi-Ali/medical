<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService){
        $this->appointmentService = $appointmentService;
    }

    public function index(){
        $appointments = $this->appointmentService->getPatientAppointments(auth()->user()->id);
        return view('patients.booked-appointments', compact('appointments'));
    }

    public function store(Request $request){
        // Validate the request
        $request->validate([
            'schedule_id' => 'required|exists:availability_schedules,id',
        ]);
        $this->appointmentService->bookAppointment($request->schedule_id);
        return back()->with('success', 'Appointment booked successfully.');
    }

    public function cancel($appointmentId){
        $this->appointmentService->cancelAppointment($appointmentId);
        return back()->with('success', 'Appointment cancelled!');
    }
}
