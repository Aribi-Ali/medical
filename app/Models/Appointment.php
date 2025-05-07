<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        "availability_schedule_id",
        "status",
        "user_id",
        "doctor_id",
    ];

    // Relationships
    public function patient() {
        return $this->belongsTo(User::class);
    }

    public function doctorDetail() {
        return $this->belongsTo(DoctorDetails::class, 'doctor_id', 'user_id');
    }

    public function schedule(){
        return $this->belongsTo(AvailabilitySchedule::class, 'availability_schedule_id');
    }
}
