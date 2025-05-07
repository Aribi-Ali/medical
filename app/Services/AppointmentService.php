<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\AvailabilitySchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentService{
    public function bookAppointment($availabilityScheduleId){
        $patient = Auth::user();
        $schedule = AvailabilitySchedule::findOrFail($availabilityScheduleId);

        if (!$schedule->is_available) {
            return redirect()->back()->with('error', 'The selected schedule is no longer available.');
        }

        // Book the appointment
        Appointment::create([
            'user_id' => $patient->id,
            'doctor_id' => $schedule->doctor_detail_id,
            'availability_schedule_id' => $schedule->id
        ]);

        // Mark the schedule as unavailable
        $schedule->update(['is_available' => false]);
    }

    public function getPatientAppointments($patientId)
    {
        return Appointment::with([
            'doctorDetail' => function ($query) {
                $query->select('id', 'user_id', 'specialization', 'bio'); // Ensure necessary fields are loaded
            },
            'doctorDetail.user' => function ($query) {
                $query->select('id', 'name'); // Adjust as needed
            },
            'schedule' => function($query) {
                $query->select('id', 'day_of_week', 'start_time', 'end_time', 'is_available');
            }
        ])
            ->where('user_id', $patientId)
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'status' => $appointment->status,
                    'schedule' => [
                        'day' => $appointment->schedule->day_of_week,
                        'start_time' => $appointment->schedule->start_time,
                        'end_time' => $appointment->schedule->end_time,
                        'is_available' => $appointment->schedule->is_available
                    ],
                    'doctorDetail' => [
                        'id' => $appointment->doctorDetail->user_id,
                        'name' => $appointment->doctorDetail->user->name,
                        'specialization' => $appointment->doctorDetail->specialization,
                        'bio' => $appointment->doctorDetail->bio
                    ]
                ];
            });
    }

    public function cancelAppointment($appointmentId){
        DB::transaction(function () use ($appointmentId) {
            // Find the appointment with its schedule
            $appointment = Appointment::with('schedule')->findOrFail($appointmentId);

            // Get the associated schedule
            $schedule = $appointment->schedule;

            // Delete the appointment
            $appointment->delete();

            // 4. Update the schedule availability
            $schedule->update(['is_available' => true]);

            return true;
        });
    }
}
