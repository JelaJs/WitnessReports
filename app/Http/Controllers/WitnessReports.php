<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WitnessReports extends Controller
{
    public function index()
    {
        return response()->json(['Key' => 'Data']);
    }
}
