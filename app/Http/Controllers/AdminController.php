<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService) {
        $this->adminService = $adminService;
    }

    public function index(Request $request)
    {
        $users = $this->adminService->findUserByEmail($request->get("email"));
        return view('admin.manage-user', compact('users'));
    }

    public function toggleStatus(User $user)
    {
        $this->adminService->toggleUserStatus($user->id);
        return redirect()->back()->with('success', "User status updated successfully.");
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:patient,doctor,pharmacist,admin'
        ]);

        $this->adminService->updateUserRole($user->id, $request->role);
        return redirect()->back()->with('success', "User role updated successfully.");
    }
}
