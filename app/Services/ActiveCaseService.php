<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ActiveCaseService
{
    public function getActiveCases($name)
    {
        $separatedString = explode(' ', $name);
        $urlString = implode('+', $separatedString);

        $JsonResponse = Http::get("https://api.fbi.gov/wanted/v1/list?title={$urlString}");
        return json_decode($JsonResponse);
    }
}
