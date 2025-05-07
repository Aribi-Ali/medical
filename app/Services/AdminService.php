<?php

namespace App\Services;

use App\Models\User;

class AdminService {
    public function findUserByEmail($email){
        $query = User::query();
        if($email){
            $query->where('email', 'LIKE', '%' . $email . '%');
        }
        $users = $query->get();
        return $users;
    }

    public function toggleUserStatus($userId){
        $user = User::findOrFail($userId);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();
        return $user;
    }

    public function updateUserRole($userId, $newRole){
        $validRoles = ['patient', 'doctor', 'pharmacist', 'admin'];
        if (!in_array($newRole, $validRoles)) {
            throw new \InvalidArgumentException("Invalid role.");
        }

        $user = User::findOrFail($userId);
        $user->role = $newRole;
        $user->save();
        return $user;
    }
}
