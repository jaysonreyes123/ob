<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get("random",function(){
    return Str::random(128);
});

//access page from user
Route::get("/login",[LoginController::class,'login'])->name('login');
Route::post("/login/process",[LoginController::class,'process']);
Route::get("logout",[LoginController::class,'logout']);
Route::group(["middleware" => 'auth.access'],function(){
    Route::get('/', function () {
        return view('content.index');
    })->name('index');
    
    Route::get("product/{id}",[ProductController::class,'show'])->name('product.show');
});
Route::post("payment/process",[PaymentController::class,'process'])->name('payment.process');
Route::get("{payment}/failed",[TransactionController::class,'failed']);