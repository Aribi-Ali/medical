<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorPatientHistory extends Model
{
    protected $fillable = [
        "patient_id",
        "doctor_detail_id",
        "notes"
    ];

    // Relationships
    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
