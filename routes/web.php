<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportBarangKeluarController;
use App\Http\Controllers\ReportBarangMasukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'controller'=>LoginController::class,
], function(){
    Route::get('/','index')->name('login');
    Route::post('/auth','auth')->name('auth');
    Route::get('/logout','logout')->name('logout');
});


Route::group([
    'middleware'=>'auth'
], function(){
    Route::group([
        'controller'=>DashboardController::class,
        'as'=>'dashboard.',
    ], function(){
        Route::get('/dashboard','index')->name('index');
    });

    Route::group([
        'as'=>'user.',
        'controller'=>UserController::class,
        'prefix'=>'/user',
        'middleware'=>'isSuperAdmin',
    ], function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::get('/detail/{id}','show')->name('show');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::put('/update/{id}','update')->name('update');
        Route::get('/delete/{id}','delete')->name('delete');
    });

    Route::group([
        'as'=>'barang.',
        'controller'=>BarangController::class,
        'prefix'=>'/barang',
    ], function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::get('/detail/{id}','show')->name('show');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::put('/update/{id}','update')->name('update');
        Route::get('/delete/{id}','delete')->name('delete');
        Route::get('/auto-complete','autoComplete')->name('autoComplete');
    }); 

    Route::group([
        'as'=>'barangMasuk.',
        'controller'=>BarangMasukController::class,
        'prefix'=>'/barang-masuk',
    ], function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::get('/detail/{id}','show')->name('show');
        Route::post('/store','store')->name('store');
        // Route::get('/edit/{id}','edit')->name('edit');
        // Route::put('/update/{id}','update')->name('update');
        Route::get('/delete/{id}','delete')->name('delete');
        
    }); 

    Route::group([
        'as'=>'barangKeluar.',
        'controller'=>BarangKeluarController::class,
        'prefix'=>'/barang-keluar',
    ], function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::get('/detail/{id}','show')->name('show');
        Route::post('/store','store')->name('store');
        // Route::get('/edit/{id}','edit')->name('edit');
        // Route::put('/update/{id}','update')->name('update');
        Route::get('/delete/{id}','delete')->name('delete');
    });

    Route::group([
        'as'=>'reportBarangMasuk.',
        'controller'=>ReportBarangMasukController::class,
        'prefix'=>'/report-barang-masuk',
    ], function(){
        Route::get('/','index')->name('index');
        Route::post('/export','export')->name('export');
    });

    Route::group([
        'as'=>'reportBarangKeluar.',
        'controller'=>ReportBarangKeluarController::class,
        'prefix'=>'/report-barang-keluar',
    ], function(){
        Route::get('/','index')->name('index');
        Route::post('/export','export')->name('export');
    }); 
    
});

