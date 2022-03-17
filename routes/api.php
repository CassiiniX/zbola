<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(["prefix" => "v1","as" => "v1."],function(){
    Route::get("/status",function(){
        return response()->json([
            "message" => "Active"
        ]);
    });

    Route::group(["prefix" => "auth","namespace" => "User","as" => "auth."],function(){
        Route::post("/signin","Api\AuthController@signin")->name("signin");
        Route::post("/signup","Api\AuthController@signup")->name("signup");

        Route::group(["middleware" => ["auth:sanctum"]],function(){
            Route::post("/logout","Api\AuthController@logout")->name("logout");
            Route::get("/me","Api\AuthController@me")->name("me");
        });
    });    
});