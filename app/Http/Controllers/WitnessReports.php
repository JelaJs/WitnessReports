<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WitnessReports extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|numeric',
        ]);

        $content = "Name: {$request->name}\nPhone: {$request->phone_number}\n---\n";
        $id = Str::random(8);
        $separatedString = explode(' ', $request->name);
        $urlString = implode('+', $separatedString);

        Storage::disk('local')->append("{$request->name}-{$id}.txt", $content);

        $JsonResponse = Http::get("https://api.fbi.gov/wanted/v1/list?title={$urlString}");
        $response = json_decode($JsonResponse);

        return response()->json($response);
    }
}
