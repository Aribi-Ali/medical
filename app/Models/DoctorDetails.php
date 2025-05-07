<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDetails extends Model
{
    protected $fillable = [
        "specialization",
        "bio",
        "address",
        "wilaya",
        "user_id",
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function availabilitySchedules()
    {
        return $this->hasMany(AvailabilitySchedule::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function sharedDocuments()
    {
        return $this->hasMany(SharedDocument::class);
    }
}