<?php

namespace App\Http\Controllers;

use App\Common\ErrorCode;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        $credentials = request(['email', 'password']);
        $credentials = [
            'username' => 'test',
            'password' => '123456'
        ];
        if(! $token = auth('api')->attempt($credentials)){
            return apiResponseError(ErrorCode::UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function me(){
        return auth('api')->user();
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(){
        return auth('api')->refresh();
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
