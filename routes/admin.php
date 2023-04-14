<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GoodsController;

Route::any('/login',['App\Http\Controllers\Admin\AuthController','login']);

Route::middleware('auth:admin')->group(function (){

    Route::get('me',[App\Http\Controllers\Admin\AuthController::class,'me']);

    Route::apiResources([
        'user' => UserController::class,
        'goods' => GoodsController::class
    ]);

//    Route::apiResource('test',UserController::class)->except('show');

});
