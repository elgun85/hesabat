<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MhmLoginCategoryController;
use App\Http\Controllers\Admin\MhmLoginController;
use App\Http\Controllers\Admin\VezifeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\TarifController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

//
//Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function ()
//{
//    Route::get('/dashboard',DashboardController::class,'index')->name('admin.dashboard');
//
//});




Route::group(['middleware'=>['auth','authadmin'],'prefix'=>'admin'],function ()
{
        Route::get('Cdel/{id}',[MhmLoginCategoryController::class,'destroy'])->name('cat.del');
        Route::get('tarifDel/{id}',[TarifController::class,'destroy'])->name('tarif.del');
        Route::post('TarifdeleteAll',[TarifController::class,'multipleusersdelete'])->name('TarifdeleteAll');

        Route::post('CdeleteAll',[MhmLoginCategoryController::class,'multipleusersdelete'])->name('CdeleteAll');
        Route::post('UdeleteAll',[MhmLoginController::class,'multipleusersdelete'])->name('UdeleteAll');

        Route::post('tarifSelect',[TarifController::class,'tarifSelect'])->name('tarifSelect');

        Route::get('muser/{id}',[MhmLoginController::class,'destroy'])->name('muser.delete');
        Route::get('mvezife/{id}',[VezifeController::class,'destroy'])->name('mvezife.delete');




    Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::resource('category',MhmLoginCategoryController::class);
    Route::resource('muser',MhmLoginController::class);
    Route::resource('mvezife',VezifeController::class);
    Route::resource('tarif',TarifController::class);




        Route::get('test',[TestController::class,'skaf'])->name('test');
        Route::get('table',[ProductController::class,'table'])->name('table');
        Route::get('analiz',[TarifController::class,'analiz'])->name('analiz');
        Route::get('tarifSelect',[TarifController::class,'tarifSelect'])->name('tarifSelect');

        Route::get('telyoxla',[TarifController::class,'telyoxla'])->name('telyoxla');
        Route::get('telyoxlaS',[TarifController::class,'telyoxlaS'])->name('telyoxlaS');
        Route::get('gelir',[TarifController::class,'gelir'])->name('gelir');
        Route::get('senedlesme',[TarifController::class,'senedlesme'])->name('senedlesme');
        Route::get('texniki',[TarifController::class,'texniki'])->name('texniki');

//        Route::post('select',[TarifController::class,'select'])->name('select');

        Route::post('testdelete',[ProductController::class,'multipleusersdelete'])->name('testdelete');






//Route::get('/profile', [DashboardController::class,'profile'])->name('admin.profile');

});
