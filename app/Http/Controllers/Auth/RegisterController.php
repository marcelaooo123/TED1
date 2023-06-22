<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $token = $user->createToken('auth-token')->plainTextToken;
            $user->token = $token;

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function login(UserLoginRequest $request)
    {

        if (Auth::attempt(['email'=>$request->email,'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('api_token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        } else {
            return response()->json(['message' => 'Unauthoirized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }
}
