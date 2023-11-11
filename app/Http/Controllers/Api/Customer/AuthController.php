<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\customers\CustomerLoginRequest;
use App\Http\Requests\customers\CustomerRegisterRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(CustomerRegisterRequest $request)
    {
        $customer = Customer::create($request->validated());
        return response()->json(['message' => 'User registered successfully']);
    }


    public function login(CustomerLoginRequest $request)
    {
        $customer = Customer::where('phone', $request->phone)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            $token = $customer->createToken('user-token-name')->plainTextToken;
            return response()->json(['user-token-name' => $token]);
        }

        return response()->json(['message' => 'Invalid login credentials'], 401);
    }



    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
