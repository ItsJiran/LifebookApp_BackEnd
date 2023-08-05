<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\EditorController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\Helper;

use App\Http\Middleware\RedirectIfNotAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
 */

Route::middleware('auth')->group(function(){
    Route::redirect('/', '/home');

    Route::get('/home', function(Request $request){
        $user_data = Helper::getUserData($request);

        return view('home', compact('user_data'));
    })->name('home');

    Route::get('/journal', function(Request $request){
        return view('journal');
    })->name('journal');
});

Route::middleware([RedirectIfNotAdmin::class])->group(function(){
    Route::get('/create/materials', [MaterialsController::class, 'create'])->name('materials.create');
    Route::post('/post/materials', [MaterialsController::class,'post'])->name('materials.post');
});

/*
|--------------------------------------------------------------------------
| User Auth
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

