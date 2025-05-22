<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WitnessReports extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|numeric',
        ]);

        $JsonResponse = Http::get('https://api.fbi.gov/wanted/v1/list');
        $response = json_decode($JsonResponse);

        return response()->json($response);
    }
}
