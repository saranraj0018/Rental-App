<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PickupDeliveryController;
use App\Http\Controllers\Admin\CarDetailsController;
use App\Http\Controllers\Admin\CarBlockController;
Use App\Http\Controllers\Admin\RoleController;
Use App\Http\Controllers\Admin\BannerController;
Use App\Http\Controllers\Admin\CouponController;

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
        Route::view('/register',  'admin.register')->name('admin.register');
        Route::post('/authenticate', [AdminAuthController::class, 'adminAuthenticate'])->name('admin.authenticate');
        Route::post('/register/update', [AdminAuthController::class, 'registerUpdate'])->name('admin.register.update');
    });

    Route::group(['middleware'=> 'admin.auth'],function (){
        Route::get('/dashboard', [DashboardController::class, 'view'])->name('admin.dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // Pickup-delivery list
        Route::get('/pickup-delivery/list', [PickupDeliveryController::class, 'list'])->name('pickup-delivery.list');

        // Cars list
        Route::get('/cars/list', [CarDetailsController::class, 'list'])->name('car.list');
        Route::post('/car/save', [CarDetailsController::class, 'save'])->name('car.save');
        Route::delete('/car/{id?}/delete', [CarDetailsController::class, 'delete'])->name('car.delete');
        Route::get('/cars/search', [CarDetailsController::class, 'search'])->name('cars.search');

        // Car Models
        Route::post('/car/model/save', [CarDetailsController::class, 'saveModels'])->name('model.save');

        // Car-block list
        Route::get('/car-block/list', [CarBlockController::class, 'list'])->name('car-block.list');
        Route::post('/car-block/save', [CarBlockController::class, 'save'])->name('car-block.save');
        Route::put('/car-block/update', [CarBlockController::class, 'update'])->name('car-block.update');
        Route::get('/car-block/search', [CarBlockController::class, 'search'])->name('car-block.search');

        // User Role list
        Route::get('/user-role/list', [RoleController::class, 'list'])->name('user-role.list');
        Route::post('/user-role/save', [RoleController::class, 'save'])->name('user-role.save');
        Route::put('/user-role/update', [RoleController::class, 'update'])->name('user-role.update');
        Route::delete('/user-role/{id?}/delete', [RoleController::class, 'delete'])->name('user-role.delete');


        // Front-end Banner Section
        Route::get('/banner', [BannerController::class, 'view'])->name('banner.list');
        Route::post('/banner/save', [BannerController::class, 'save'])->name('banner.save');

        //Coupon Section
        Route::get('/coupon/list', [CouponController::class, 'list'])->name('coupon.list');
        Route::post('/coupon/save', [CouponController::class, 'save'])->name('coupon.save');
        Route::delete('/coupon/{id?}/delete', [CouponController::class, 'delete'])->name('coupon.delete');
        Route::get('/coupon/search', [CouponController::class, 'search'])->name('coupon.search');

        // Front-end Car - Info Section
        Route::get('/car-info', [BannerController::class, 'carInfo'])->name('car-info.view');
        Route::post('/car-info/save', [BannerController::class, 'carSave'])->name('car-info.save');

        // Front-end Car - Brand Section
        Route::get('/brand', [BannerController::class, 'brandList'])->name('brand.view');
        Route::post('/brand/save', [BannerController::class, 'brandSave'])->name('brand.save');
        Route::delete('/brand/{id?}/delete', [BannerController::class, 'delete'])->name('brand.delete');

        // Faq list
        Route::get('/faq/list', [BannerController::class, 'faqList'])->name('faq.list');
        Route::post('/faq/save', [BannerController::class, 'faqSave'])->name('faq.save');
        Route::delete('/faq/{id?}/delete', [BannerController::class, 'faqDelete'])->name('faq.delete');
        Route::get('/faq/search', [BannerController::class, 'search'])->name('faq.search');

    });
});
