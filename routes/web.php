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

Route::middleware('auth')->group(function(){
    Route::redirect('/', '/home');
    Route::get('/home', function(){ return view('home'); })->name('home');
});


/*
|--------------------------------------------------------------------------
| User Auth
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

