<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WitnessReports extends Controller
{
    public function index(ReportRequest $request)
    {
        $content = "Name: {$request->name}\nPhone: {$request->phone_number}\n---\n";
        $id = Str::random(8);
        $separatedString = explode(' ', $request->name);
        $urlString = implode('+', $separatedString);
        $ipAddress = $request->ip();

        $locationJson = Http::get("http://ip-api.com/json/{$ipAddress}");
        $location = json_decode($locationJson);

        Storage::disk('local')->append("{$request->name}-{$id}.txt", $content);

        $JsonResponse = Http::get("https://api.fbi.gov/wanted/v1/list?title={$urlString}");
        $response = json_decode($JsonResponse);

       return response()->json([
           'Active cases' => $response->total,
           'User Country' => $location->country,
           'User City' => $location->city,
        ]);
    }
}
