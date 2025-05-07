<?php

namespace App\Services;

use App\Http\Requests\AvailabilityScheduleRequest;
use App\Models\AvailabilitySchedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AvailabilityScheduleService{

    public function getAllAvailableSchedules(int $doctorId){
        // Get the authenticated user
        $user = Auth::user();
        if ($user->id !== $doctorId) {
            throw new \Exception('You are not authorized to access these schedules.');
        }

        return AvailabilitySchedule::where("doctor_detail_id", $doctorId)
            ->orderBy('is_available', 'desc')
            ->get();
    }

    public function setAvailability(AvailabilityScheduleRequest $request) {
        $user = Auth::user();
        if ($user->role !== 'doctor') {
            throw ValidationException::withMessages(['error' => 'Only doctors can set availability.']);
        }

        foreach ($request->get('timeSlots', []) as $timeSlot) {
            // Remove old slots for that day (avoid duplicates)
            AvailabilitySchedule::where('doctor_detail_id', $user->id)
                ->where('day_of_week', $timeSlot['dayOfWeek'])
                ->delete();

            // Generate new slots
            $this->generateTimeSlots($user->id, $timeSlot['dayOfWeek'], $timeSlot['startTime'], $timeSlot['endTime'], $request->get("slotDuration"));
        }
    }

    public function getWorkingDays(){
        $user = Auth::user();
        if ($user->role !== 'doctor') {
            throw ValidationException::withMessages(['error' => 'Only doctors can set availability.']);
        }
        // Fetch all schedules for the doctor
        $schedules = AvailabilitySchedule::where('doctor_detail_id', $user->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        // Group schedules by day_of_week
        $groupedSchedules = $schedules->groupBy('day_of_week');

        // Process each day
        $workingDays = [];
        foreach ($groupedSchedules as $day => $daySchedules) {
            // Get the start time of the first schedule
            $startTime = $daySchedules->first()->start_time;

            // Get the end time of the last schedule
            $endTime = $daySchedules->last()->end_time;

            // Add the day to the result
            $workingDays[] = [
                'dayOfWeek' => $day,
                'startTime' => $startTime,
                'endTime' => $endTime,
            ];
        }

        return $workingDays;
    }

    public function getAvailableSchedules($id){
        // Fetch the doctor
        $doctor = User::findOrFail($id);

        // Fetch available schedules for the doctor
        $schedules = AvailabilitySchedule::where('doctor_detail_id', $doctor->id)
            ->where('is_available', true)
            ->get();

        return $schedules;
    }

    public function deleteAvailability(string $dayOfWeek){
        AvailabilitySchedule::where('day_of_week', $dayOfWeek)->delete();
    }

    public function resetAll(){
        DB::transaction(function () {
            AvailabilitySchedule::where('doctor_detail_id', Auth::user()->id)
                ->update(['is_available' => true]);
        });
    }

    private function generateTimeSlots($doctorId, $dayOfWeek, $startTime, $endTime, $duration)
    {
        $current = strtotime($startTime);
        $end = strtotime($endTime);

        while ($current + ($duration * 60) <= $end) {
            AvailabilitySchedule::create([
                'doctor_detail_id' => $doctorId,
                'day_of_week' => $dayOfWeek,
                'start_time' => date('H:i', $current),
                'end_time' => date('H:i', $current + ($duration * 60)),
                'slot_duration' => $duration,
            ]);

            $current += ($duration * 60);
        }
    }
}
