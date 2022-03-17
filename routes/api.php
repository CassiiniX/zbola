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

    Route::group(["middleware" => ["isNotAuth"],"prefix" => "auth","namespace" => "User","as" => "auth."],function(){
        Route::post("/signin","Api\AuthController@signin")->name("signin");
        Route::post("/signup","Api\AuthController@signup")->name("signup");

        Route::group(["middleware" => ["auth:sanctum"]],function(){
            Route::post("/logout","Api\AuthController@logout")->name("logout");
            Route::get("/me","Api\AuthController@me")->name("me");
        });
    });    

    Route::group(["middleware" => ["auth:sanctum","isUser"],"prefix" => "user","namespace" => "User","as" => "user."],function(){
        Route::get("/","Api\HomeController@index")->name("home");
		Route::post("/profil/edit-data","Api\ProfilController@editData")->name("edit.data");
		Route::post("/profil/edit-photo","Api\ProfilController@editPhoto")->name("edit.photo");

		Route::get("/product","Api\ProductController@index")->name("product");
		Route::get("/product/{id}","Api\ProductController@detail")->name("product.detail");	

		Route::post("/order","Api\OrderController@order")->name("order");
		Route::get("/order/{id}","Api\OrderController@detail")->name("order.detail");

		Route::get("/invoice","Api\InvoiceController@index")->name("invoice");
		Route::get("/history-invoice","Api\InvoiceController@history")->name("invoice.history");
		Route::get("/invoice/cancel","Api\InvoiceController@cancel")->name("action.invoice.cancel");

		Route::get("/manual-payment","Api\PaymentController@index")->name("manual-payment");
		Route::post("/payment","Api\PaymentController@payment")->name("action.manual-payment");

		Route::get("/notification","Api\NotificationController@index")->name("notification");
		
		Route::post("/review","Api\ReviewController@review")->name("action.review");	
    });
});