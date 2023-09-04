<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\JWTokenController;

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


Route::post('/api/login',[JWTokenController::class,'login'])->name('token.login');
Route::post('/api/logout',[JWTokenController::class,'logout'])->name('token.logout');


//Route::get('/token',[JWTokenController::class,'get'])->name('token.get');
