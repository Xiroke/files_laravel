<?php

namespace App\Http\Reponses;

use Illuminate\Http\JsonResponse;

class UnauthorizedResponse
{
    public static function make(): JsonResponse
    {
        return response()->json(['detail' => 'Ошибка аутентификации'], 401);
    }
}
