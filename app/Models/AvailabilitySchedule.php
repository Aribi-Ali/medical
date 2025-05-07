<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilitySchedule extends Model
{
    protected $fillable = [
        'doctor_detail_id',
        "day_of_week",
        "start_time",
        "end_time",
        "slot_duration",
        "is_available"
    ];

    // Relationships
    public function doctorDetail() {
        return $this->belongsTo(DoctorDetails::class, 'doctor_detail_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class, 'availability_schedule_id');
    }
}
