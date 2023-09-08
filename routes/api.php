<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\JWTokenController;
use App\Http\Middleware\Api;

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

Route::post('/api/login',[JWTokenController::class,'login']);

Route::group([
    'middleware' => 'api.auth',
], function ($router) {
    Route::get('/api/me',[JWTokenController::class,'me'])->name('token.me');
    Route::post('/api/refresh',[JWTokenController::class,'refresh'])->name('token.refresh');
    Route::post('/api/logout',[JWTokenController::class,'logout']);
});





//Route::get('/token',[JWTokenController::class,'get'])->name('token.get');
