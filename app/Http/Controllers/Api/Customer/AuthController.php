<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\customers\CustomerLoginRequest;
use App\Http\Requests\customers\CustomerRegisterRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseTrait;
    public function register(CustomerRegisterRequest $request)
    {
        $customer = Customer::create($request->validated());

        return $this->successData(new CustomerResource($customer));
    }


    public function login(CustomerLoginRequest $request)
    {
        $customer = Customer::where('phone', $request->phone)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            $token = $customer->createToken('user-token-name')->plainTextToken;
            $customer->token = $token;
            return $this->successData(new CustomerResource($customer));
        }

        return $this->failMsg('Login failed');
    }



    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successMsg('Logout successfully');
    }
}
