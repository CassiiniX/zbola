<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(["middleware" => "isMaintaince"],function(){	
	Route::get('/',"HomeController@index")->name("home");

	Route::get("/logout","User\Action\AuthController@logout")->name("logout");

	Route::group(["middleware" => "isNotAuth","namespace" => "User"],function(){	
		Route::get("/signin","AuthController@signin")->name("signin");
		Route::get("/signup","AuthController@signup")->name("signup");
		Route::post("/signin","Action\AuthController@actionSignin")->name("action.signin");
		Route::post("/signup","Action\AuthController@actionSignup")->name("action.signup");
	});

	Route::group(["middleware" => "isUser","namespace" => "User","prefix" => "user","as" => "user."],function(){
		Route::get("/","HomeController@index")->name("home");
		Route::get("/profil","ProfilController@index")->name("profil");
		Route::post("/profil/edit-data","Action\ProfilController@editData")->name("edit.data");
		Route::post("/profil/edit-photo","Action\ProfilController@editPhoto")->name("edit.photo");

		Route::get("/product","ProductController@index")->name("product");
		Route::get("/product/{id}","ProductController@detail")->name("product.detail");	

		Route::post("/order","Action\OrderController@order")->name("order");
		Route::get("/order/{id}","OrderController@detail")->name("order.detail");

		Route::get("/invoice","InvoiceController@index")->name("invoice");
		Route::get("/history-invoice","InvoiceController@history")->name("invoice.history");
		Route::get("/invoice/cancel","Action\InvoiceController@cancel")->name("action.invoice.cancel");

		Route::get("/manual-payment","PaymentController@index")->name("manual-payment");
		Route::post("/payment","Action\PaymentController@payment")->name("action.manual-payment");

		Route::get("/notification","NotificationController@index")->name("notification");
		
		Route::post("/review","Action\ReviewController@review")->name("action.review");	
	});

	Route::group(["middleware" => "isAdmin","namespace" => "Admin","prefix" => "admin","as" => "admin."],function(){
		Route::get("/","HomeController@index")->name("home");

		Route::get("/user","UserController@index")->name("user");
		Route::post("/user/edit/{user}","Action\UserController@edit")->name("action.user.edit");

		Route::get("/review","ReviewController@index")->name("review");
		Route::get("/review/delete/{review}","Action\ReviewController@delete")->name("action.review.delete");

		Route::get("/setting","SettingController@index")->name("setting");
		Route::post("/setting","Action\SettingController@update")->name("action.setting.update");

		Route::get("/product","ProductController@index")->name("product");
		Route::post("/product/add","Action\ProductController@create")->name("action.product.add");
		Route::post("/product/edit/{product}","Action\ProductController@edit")->name("action.product.edit");

		Route::get("/invoice","InvoiceController@index")->name("invoice");
		Route::get("/invoice/detail/{id}","InvoiceController@detail")->name("invoice.detail");

		Route::get("/invoice/rejected/{id}","Action\InvoiceController@rejected")->name("action.invoice.rejected");
		Route::get("/invoice/approve/{id}","Action\InvoiceController@approve")->name("action.invoice.approve");
		Route::get("/invoice/waiting/{id}","Action\InvoiceController@waiting")->name("action.invoice.waiting");
		Route::get("/invoice/running/{id}","Action\InvoiceController@running")->name("action.invoice.running");
		Route::get("/invoice/failed/{id}","Action\InvoiceController@failed")->name("action.invoice.failed");
		
		Route::get("/manual-payment","ManualPaymentController@index")->name("manual-payment");
		Route::get("/manual-payment/detail/{id}","ManualPaymentController@detail")->name("manual-payment.detail");	

		Route::get("/manual-payment/success/{id}","Action\ManualPaymentController@success")->name("action.manual-payment.success");
		Route::get("/manual-payment/failed/{id}","Action\ManualPaymentController@failed")->name("action.manual-payment.failed");
		Route::get("/manual-payment/completed/{id}","Action\ManualPaymentController@completed")->name("action.manual-payment.completed");

		Route::get("/report","ReportController@index")->name("report");
		Route::get("/report/invoice","ReportController@invoice")->name("report.invoice");
	});
});