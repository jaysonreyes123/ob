<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('content.index');
});

Route::get("product/{id}",[ProductController::class,'show'])->name('product.show');
Route::post("payment/process",[PaymentController::class,'process'])->name('payment.process');

Route::get("{payment}/failed",[TransactionController::class,'failed']);