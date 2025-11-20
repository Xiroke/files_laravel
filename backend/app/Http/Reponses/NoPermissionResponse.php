<?php

namespace App\Http\Reponses;

use Illuminate\Http\JsonResponse;

class NoPermissionResponse
{
    public static function make(): JsonResponse
    {
        return response()->json(['detail' => 'Недостаточно прав'], 403);
    }
}
