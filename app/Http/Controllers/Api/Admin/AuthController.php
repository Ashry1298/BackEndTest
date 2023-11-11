<?php

namespace App\Http\Controllers\Api\Admin\AuthController;


use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admins\AdminLoginRequest;
use App\Http\Requests\admins\AdminRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(AdminRegisterRequest $request)
    {
        $admin = Admin::create($request->validated());
        return response()->json(['message' => 'Admin registered successfully'], 201);
    }

    public function login(AdminLoginRequest $request)
    {
        if (!$admin = Admin::where(['phone' => $request->phone, 'password' => $request->password])->first()) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $admin->createToken('admin-token-name')->plainTextToken;

        return response()->json(['access_token' => $token]);
    }
}
