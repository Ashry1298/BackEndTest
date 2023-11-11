<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admins\AdminLoginRequest;
use App\Http\Requests\admins\AdminRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ResponseTrait;


    public function register(AdminRegisterRequest $request)
    {
        $admin = Admin::create($request->validated());

        return $this->successData(new AdminResource($admin));
    }

    public function login(AdminLoginRequest $request)
    {
        if (!$admin = Admin::where(['phone' => $request->phone, 'password' => $request->password])->first()) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $admin->createToken('admin-token-name')->plainTextToken;

        $admin->token = $token;

        return $this->successData(new AdminResource($admin));
    }




    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        

        return $this->successMsg('logged out successfully');
    }
}
