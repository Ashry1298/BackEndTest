<?php

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register($request, $type)
    {
        $user = User::create($request->validated());
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login( $request)
    {
        if (!Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user = $request->user();

        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json(['access_token' => $token]);
    }
}
