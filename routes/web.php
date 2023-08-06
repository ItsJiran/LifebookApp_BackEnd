<?php

use Illuminate\Support\Facades\Route;
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
| Web Routes
|--------------------------------------------------------------------------
 */

Route::middleware('auth')->group(function(){
    Route::redirect('/', '/home');

    Route::get('/home', function(Request $request){
        $user = BasicDataHelper::getUserData($request);
        $materials = BasicDataHelper::getMaterialsData($request);

        return view('home', compact('user','materials'));
    })->name('home');

    Route::get('/journal', function(Request $request){
        $user = BasicDataHelper::getUserData($request);

        return view('journal', compact('user'));
    })->name('journal');

    Route::get('/settings', function(Request $request){
        return view('settings');
    })->name('settings');
});

Route::post('refresh-csrf',function(){
    return csrf_token();
});
Route::post('test-csrf',function(){
    return 'Token must have been valid';
});

/*
|--------------------------------------------------------------------------
| View
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function(){
    Route::get('/view/materials/{id}', [MaterialsController::class,'view'])->name('materials.view');
    Route::get('/create/journals', [JournalsController::class, 'create'])->name('journals.create');
});

/*
|--------------------------------------------------------------------------
| Middleware Files
|--------------------------------------------------------------------------
*/
Route::middleware([RedirectIfNotAdmin::class])->group(function(){
    Route::get('/create/materials', [MaterialsController::class, 'create'])->name('materials.create');
    Route::post('/post/materials', [MaterialsController::class,'post'])->name('materials.post');
});


require __DIR__ . '/auth.php';

