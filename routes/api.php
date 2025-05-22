<?php

use App\Http\Controllers\WitnessReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function (Request $request) {
    return response()->json(['Test Key' => 'Test Data']);
});*/

Route::post('/report', [WitnessReports::class, 'index']);
