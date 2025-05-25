<?php

namespace App\Http\Controllers;

use App\Facades\ResponseFacade;
use App\Http\Requests\ReportRequest;
use App\Services\ActiveCaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WitnessReports extends Controller
{
    public function index(ReportRequest $request, ActiveCaseService $activeCaseService)
    {
        $content = "Name: {$request->name}\nPhone: {$request->phone_number}\n---\n";
        $id = Str::random(8);
        $ipAddress = $request->ip();

        $locationJson = Http::get("http://ip-api.com/json/{$ipAddress}");
        $location = json_decode($locationJson);

        Storage::disk('local')->append("{$request->name}-{$id}.txt", $content);

        $cases = $activeCaseService->getActiveCases($request->name);

        return ResponseFacade::jsonSuccess(
            data: [
                'Active cases' => $cases->total,
                'User Country' => $location->country,
                'User City' => $location->city,
            ],
        );
    }
}
