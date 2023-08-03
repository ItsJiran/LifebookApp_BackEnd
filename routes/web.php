<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EditorController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::redirect('/', '/dashboard');
Route::get('/dashboard', function(){
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| User Auth
|--------------------------------------------------------------------------
*/


Route::get('/login', function(){
    return view('login');
});
Route::get('/register', function(){
    return view('register');
});

Route::post('/login', function(){

});
Route::post('/register', function(){

});
