<?php

namespace App\Http\Controllers\Admin;

use App\Common\ErrorCode;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(){
        $credentials = request(['username', 'password']);
        if(! $token = auth('admin')->attempt($credentials)){
            return apiResponseError(ErrorCode::LOGIN_VERIFY_FAIL);
        }

        return apiResponse(data: $this->respondWithToken($token));
    }

    public function me(){
        $user = auth('admin')->user();
//        ->only('id','username','nickname','email','tel')
        $menus = Menu::getMenusByUser($user,true);
        $userInfo = $user->only('id','username','nickname','email','tel');
        $userInfo['menus'] = $menus;
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
