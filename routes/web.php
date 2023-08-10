<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\EditorController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\JournalsController;


use App\Http\Helper\BasicDataHelper;
use App\Http\Middleware\RedirectIfNotAdmin;

/*
|--------------------------------------------------------------------------
| REDIRECT IF NOT AUTHENTICATED BUT FOR VIEW METHOD 
|--------------------------------------------------------------------------
 */

// FOR CLIENT CHANGING PASSWORD
Route::get('/hash/{password}',function($password){
	return Hash::make($password);	
});
Route::post('refresh-csrf',function(){
    return csrf_token();
});
Route::post('test-csrf',function(){
    return 'Token must have been valid';
});

Route::middleware('auth')->group(function(){
    Route::redirect('/', '/home');

    Route::get('/home', function(Request $request){
        $user = BasicDataHelper::getUserData($request);
        $materials = BasicDataHelper::getMaterialsData($request);
        return view('home', compact('user','materials'));
    })->name('home');

    Route::get('/journal', function(Request $request){
        $user = BasicDataHelper::getUserData($request);
        $journals = BasicDataHelper::getJournalsData($request);
        return view('journal', compact('user','journals'));
    })->name('journal');

    Route::get('/settings', function(Request $request){
        $user = BasicDataHelper::getUserData($request);
        return view('settings',compact('user','journals'));
    })->name('settings');
});

/*
|--------------------------------------------------------------------------
| REDIRECT IF NOT AUTHENTICATED BUT FOR CRUD METHOD 
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function(){
    // ======== MATERIALS
    Route::get('/view/materials/{id}', [MaterialsController::class,'view'])->name('materials.view');

    // ======== JOURNALS 
    Route::get('/create/journals', [JournalsController::class, 'create'])->name('journals.create');
    Route::get('/edit/journals/{id}', [JournalsController::class, 'edit'])->name('journals.edit');

    Route::post('/post/journals', [JournalsController::class, 'post'])->name('journals.post');
    Route::put('/put/journals', [JournalsController::class,'update'])->name('journals.update');
    Route::get('/delete/journals/{id}', [JournalsController::class,'delete'])->name('journals.delete');
});

/*
|--------------------------------------------------------------------------
| REDIRECT IF NOT ADMIN GROUP
|--------------------------------------------------------------------------
*/
Route::middleware([RedirectIfNotAdmin::class])->group(function(){
    // ======== MATERIALS
    Route::get('/create/materials', [MaterialsController::class, 'create'])->name('materials.create');
    Route::post('/post/materials', [MaterialsController::class,'post'])->name('materials.post');
});


require __DIR__ . '/auth.php';

