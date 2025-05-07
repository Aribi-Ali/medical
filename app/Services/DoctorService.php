<?php

namespace App\Services;

use App\Models\User;

class DoctorService {
    public function searchDoctors($query)
    {
        if (empty($query)) {
            return collect();
        }

        $searchTerm = strtolower($query);

        return User::with('doctorDetails')
            ->where('role', 'doctor')
            ->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereHas('doctorDetails', function($q) use ($searchTerm) {
                        $q->whereRaw('LOWER(specialization) LIKE ?', ["%{$searchTerm}%"]);
                    });
            })
            ->get()
            ->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'name' => $doctor->name,
                    'specialization' => $doctor->doctorDetails->specialization,
                    'address' => $doctor->doctorDetails->address,
                    'wilaya' => $doctor->doctorDetails->wilaya,
                    'bio' => $doctor->doctorDetails->bio ?? ''
                ];
            });
    }
}
