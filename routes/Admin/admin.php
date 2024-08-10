<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PickupDeliveryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group(['prefix'=> 'admin'],function (){
    Route::group(['middleware'=> 'admin.guest'],function (){
        Route::view('/login',  'admin.login')->name('admin.login');
        Route::post('/authenticate', [AdminAuthController::class, 'adminAuthenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware'=> 'admin.auth'],function (){
        Route::get('/dashboard', [DashboardController::class, 'view'])->name('admin.dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // Pickup-delivery list
        Route::get('/pickup-delivery/list', [PickupDeliveryController::class, 'list'])->name('pickup-delivery.list');

        // Cars list
        Route::get('/cars/list', [\App\Http\Controllers\Admin\CarDetailsController::class, 'list'])->name('car.list');
    });
});
