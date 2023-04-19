<?php

namespace App\Http\Controllers\Admin;

use App\Common\ErrorCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(){
        $credentials = request(['username', 'password']);
        if(! $token = auth('admin')->attempt($credentials)){
            return apiResponseError(ErrorCode::UNAUTHORIZED);
        }

        return apiResponse(data: $this->respondWithToken($token));
    }

    public function me(){
        $userInfo = auth('admin')->user();
        return apiResponse(data: $userInfo);
    }

    public function logout(){
        auth()->logout();
        return apiResponse();
    }

    public function refresh(){
        return auth()->refresh();
    }

    protected function respondWithToken($token){
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
