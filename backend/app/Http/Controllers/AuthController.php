<?php

namespace App\Http\Controllers;

use App\Http\Reponses\UnauthorizedResponse;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * Вход
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken("auth-token")->plainTextToken;

            return response()->json(['token' => $token, 'token_type' => 'Bearer']);
        }

        return UnauthorizedResponse::make();
    }

    /**
     * Регистрация
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function signup(StoreUserRequest $request)
    {
        $credentials = $request->validated();

        $user = User::create($credentials);

        $token = $user->createToken("auth-token")->plainTextToken;

        return response()->json(['token' => $token, 'token_type' => 'Bearer']);
    }

    /**
     * Выход
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        // блокируем токен
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Вы вышли из аккаунта']);
    }
}
