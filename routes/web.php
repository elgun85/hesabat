<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MhmLoginCategoryController;
use App\Http\Controllers\Admin\MhmLoginController;
use App\Http\Controllers\Admin\VezifeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\NavbarController;
use App\Http\Controllers\Admin\AboutController;

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




Route::get('/',[MainController::class,'index'])->name('front.dashboard');
Route::get('/about',[MainController::class,'about'])->name('front.about');


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
        Route::get('test1',[TestController::class,'test1'])->name('test1');
        Route::get('api',[TestController::class,'api'])->name('api');
        Route::get('saxeli',[TestController::class,'saxeli'])->name('saxeli');

        Route::get('table',[ProductController::class,'table'])->name('table');
        Route::get('analiz',[TarifController::class,'analiz'])->name('analiz');
        Route::get('tarifSelect',[TarifController::class,'tarifSelect'])->name('tarifSelect');

        Route::get('telyoxla',[TarifController::class,'telyoxla'])->name('telyoxla');
        Route::get('telyoxlaS',[TarifController::class,'telyoxlaS'])->name('telyoxlaS');
        Route::get('gelir',[TarifController::class,'gelir'])->name('gelir');
        Route::get('Data_monthly',[TarifController::class,'Data_monthly'])->name('Data_monthly');
        Route::get('data_cari',[TarifController::class,'data_cari'])->name('data_cari');
        Route::get('senedlesme',[TarifController::class,'senedlesme'])->name('senedlesme');
        Route::get('texXid',[TarifController::class,'texXid'])->name('texXid');
        Route::get('siyahi',[TarifController::class,'siyahi'])->name('siyahi');
        Route::get('sen_edv',[TarifController::class,'sen_edv'])->name('sen_edv');
        Route::get('hesablanma',[TarifController::class,'hesablanma'])->name('hesablanma');
        Route::get('kod_tarif',[TarifController::class,'kod_tarif'])->name('kod_tarif');
        Route::get('data_naz',[TarifController::class,'data_naz'])->name('data_naz');
        Route::get('hes_siyahi',[TarifController::class,'hes_siyahi'])->name('hes_siyahi');
        Route::get('hes_yoxla',[TarifController::class,'hes_yoxla'])->name('hes_yoxla');
        Route::get('texniki',[TarifController::class,'texniki'])->name('texniki');
        Route::get('xidmet',[TarifController::class,'xidmet'])->name('xidmet');

//        Route::post('select',[TarifController::class,'select'])->name('select');

        Route::post('testdelete',[ProductController::class,'multipleusersdelete'])->name('testdelete');

        //front
    Route::resource('navbar',NavbarController::class);
    Route::resource('about',AboutController::class);



    Route::get('navbarDel/{id}',[NavbarController::class,'destroy'])->name('navbar.delete');
    Route::get('aboutDel/{id}',[AboutController::class,'delete'])->name('about.delete');







//Route::get('/profile', [DashboardController::class,'profile'])->name('admin.profile');

});
