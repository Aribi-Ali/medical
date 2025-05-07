<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedDocument extends Model
{
    protected $fillable = [
        "patient_id",
        "doctor_detail_id",
        "document_path",
    ];

    // Relationships
    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
}
