<?php

if (!function_exists('getDashboardText')) {
    function getDashboardText()
    {
        $user = auth()->user();

        if ($user->role === 'doctor') {
            return __('👨‍⚕️ Doctor Dashboard');
        } elseif ($user->role === 'pharmacist') {
            return __('Pharmacist Dashboard');
        } elseif ($user->role === 'admin') {
            return __('Admin Dashboard');
        }
    }
}
