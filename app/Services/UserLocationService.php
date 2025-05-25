<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UserLocationService
{
    public function getUserLocation($ipAddress)
    {
        $locationJson = Http::get("http://ip-api.com/json/{$ipAddress}");
        return json_decode($locationJson);
    }
}
