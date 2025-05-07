<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingSchedule extends Model
{
    protected $fillable = ['pharmacy_id', 'day', 'open_time', 'close_time'];

    // Relationships
    public function pharmacy() {
        return $this->belongsTo(Pharmacy::class);
    }
}
