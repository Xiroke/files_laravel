<?php

namespace App\Http\Reponses;

use Illuminate\Http\JsonResponse;

class FileAlreadyExistResponse
{
    public static function make(): JsonResponse
    {
        return response()->json(['detail' => 'Файл с таким именем уже существует'], 409);
    }
}
