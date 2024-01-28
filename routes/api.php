<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RoutinesController;
use App\Http\Controllers\Api\JournalsController;
use App\Http\Controllers\Api\JWTokenController;
use App\Http\Controllers\Api\MaterialsController;
use App\Http\Controllers\Api\UserController;

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
Route::post('/api/register',[UserController::class,'store']);
Route::get('/api/refresh',[JWTokenController::class,'refresh'])->name('token.refreshJWT');

Route::get('/api/routines/icons',[RoutinesController::class,'getIcons']);

// General Request
Route::group([
    'middleware' => ['api.auth'],
], function ($router) {
    Route::get('/api/me',[JWTokenController::class,'me'])->name('token.me');
    Route::post('/api/logout',[JWTokenController::class,'logout']);

    // MATERIALS
    Route::get('/api/materials',[MaterialsController::class,'query']);
    Route::get('/api/material/{id}',[MaterialsController::class,'view']);

    // ROUTINES
    Route::get('/api/routines',[RoutinesController::class, 'query']);
    Route::get('/api/routine/info/{id}',[RoutinesController::class, 'info']);

    Route::get('/api/routine/query/{id}/{year}/{month}',[RoutinesController::class, 'queryMonth']);

    Route::put('/api/routine/done/{id}/{year}/{month}/{day}',[RoutinesController::class, 'done']);
    Route::put('/api/routine/undone/{id}/{year}/{month}/{day}',[RoutinesController::class, 'undone']);
    Route::put('/api/routine/remove/{id}/{year}/{month}/{day}',[RoutinesController::class, 'remove']);
    Route::put('/api/routine/plus/{id}/{year}/{month}/{day}',[RoutinesController::class, 'plus']);
    Route::put('/api/routine/minus/{id}/{year}/{month}/{day}',[RoutinesController::class, 'minus']);

    // JOURNALS
    Route::get('/api/journal/{id}',[JournalsController::class, 'view']);
    Route::get('/api/journals',[JournalsController::class, 'query']);
    Route::get('/api/journals/{year}/{month}/{day}',[JournalsController::class, 'queryFullDate']);    
});
Route::group([
    'middleware' => ['api.auth','cors'],
], function ($router) {
    // JOURNALS
    Route::post('/api/journals',[JournalsController::class, 'store']);
    Route::put('/api/journal/header/{id}',[JournalsController::class, 'updateHeader']);
    Route::put('/api/journal/data/{id}',[JournalsController::class, 'updateData']);
    Route::delete('/api/journal/{id}',[JournalsController::class, 'destroy']);

    // ROUTINES
    Route::post('/api/routines',[RoutinesController::class, 'store']);
    Route::delete('/api/routine/{id}',[RoutinesController::class, 'destroy']);
    Route::put('/api/routine/{id}',[RoutinesController::class, 'update']);    
});


// Priviledge Request
Route::group([
    'middleware' => ['api.priviledge.admin'],
], function ($router) {
    // MATERIALS
    Route::post('/api/material',[MaterialsController::class,'store']);
    Route::delete('/api/material/{id}',[MaterialsController::class,'destroy']);
});



//Route::get('/token',[JWTokenController::class,'get'])->name('token.get');
