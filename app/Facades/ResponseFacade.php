<?php

namespace App\Facades;

use App\Wrappers\ResponseWrapper;
use Illuminate\Http\JsonResponse;
use JsonSerializable;

class ResponseFacade
{
    public static function jsonSuccess(array | JsonSerializable | null $data, int $status = 200): JsonResponse
    {
        return self::jsonResponse(
            new ResponseWrapper(
                data: $data,
                status: $status,
            )
        );
    }

    public static function jsonResponse(ResponseWrapper $responseWrapper): JsonResponse
    {
        return response()->json(data: $responseWrapper, status: $responseWrapper->getStatus());
    }
}
