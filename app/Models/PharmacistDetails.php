<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacistDetails extends Model
{
    protected $fillable = ["user_id"];

    // Relationships
    public function pharmacies() {
        return $this->hasMany(Pharmacy::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
