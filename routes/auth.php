<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'view'])->name('login');
    Route::get('/register', [RegisterController::class, 'view'])->name('register');

    Route::post('/login', [AuthController::class,'store']);
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function(){
    Route::get('/logout',[AuthController::class,'destroy']);
});

