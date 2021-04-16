<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Регистрация пользователя (POST)
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Successfully registered.',
            'credentials' => [
                'name' => $newUser->name,
                'email' => $newUser->email,
                'password' => $newUser->password
            ]
        ]);
    }

    /**
     * Вход в аккаунт (POST)
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
           'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user)
        {
            return response()->json([
                'message' => 'Incorrect email: user not found.'
            ], 400);
        }

        if(!Hash::check($request->password, $user->password))
        {
            return response()->json([
                'message' => 'Incorrect password: access denied.'
            ], 400);
        }

        return response()->json([
            'message' => 'Successfully logged in.',
            'access_token' => $user->createToken('Auth Token')->accessToken
        ]);
    }


    /**
     * Выход из аккаунта (POST)
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out.'
        ]);
    }
}
