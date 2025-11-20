<?php

namespace App\Http\Controllers;

use App\Http\Reponses\UnauthorizedResponse;
use App\Http\Reponses\UserAlreadyExistResponse;
use App\Http\Requests\UserCreate;
use App\Http\Requests\UserLogin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * Вход
     * @param UserLogin $request
     * @return JsonResponse
     */
    public function login(UserLogin $request)
    {
        $credentials = $request->validate([

        ]);

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken("auth-token")->plainTextToken;

            return response()->json(['token' => $token, 'token_type' => 'Bearer']);
        }

        return UnauthorizedResponse::make();
    }

    /**
     * Регистрация
     * @param UserCreate $request
     * @return JsonResponse
     */
    public function signup(UserCreate $request)
    {
        $credentials = $request->validated();

        // пользователь уже есть
        if (User::where('email', $credentials['email'])->exists()) {
            return UserAlreadyExistResponse::make();
        }

        unset($credentials['confirm_password']);

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
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Вы вышли из аккаунта']);
    }
}
