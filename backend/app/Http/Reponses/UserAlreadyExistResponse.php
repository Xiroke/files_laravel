<?php

namespace App\Http\Reponses;

use Illuminate\Http\JsonResponse;

class UserAlreadyExistResponse
{
    public static function make(): JsonResponse
    {
        return response()->json(['detail' => 'Пользователь уже существует'], 409);
    }
}
