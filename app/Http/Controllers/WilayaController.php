<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wilaya;
use Illuminate\Http\Request;

class WilayaController extends Controller
{
    public function index(){
        try {
            $wilayas = Wilaya::orderBy('zipcode')->get();

            return response()->json([
                'success' => true,
                'wilayas' => $wilayas,
                'message' => 'Wilayas retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Wilayas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
