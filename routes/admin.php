<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GoodsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\MenuController;

Route::any('/login',['App\Http\Controllers\Admin\AuthController','login']);

Route::middleware('auth:admin')->group(function (){

    Route::get('me',[App\Http\Controllers\Admin\AuthController::class,'me']);

    Route::post('file/upload',['App\Http\Controllers\Admin\FileController','upload']);

    Route::apiResources([
        'user' => UserController::class,
        'goods' => GoodsController::class,
        'banners' => BannerController::class,
        'menus' => MenuController::class
    ]);

//    Route::apiResource('test',UserController::class)->except('show');

});
