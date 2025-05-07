<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable = [
        "pharmacist_details_id",
        "name",
        "city",
        "address",
    ];

    // Relationships
    public function pharmacistDetails() {
        return $this->belongsTo(PharmacistDetails::class);
    }

    public function workingSchedules() {
        return $this->hasMany(WorkingSchedule::class);
    }
}
