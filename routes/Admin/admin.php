<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PickupDeliveryController;
use App\Http\Controllers\Admin\CarDetailsController;
use App\Http\Controllers\Admin\CarBlockController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\AvailableController;
use App\Http\Controllers\Admin\SwapController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CityController;

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



Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::view('/login', 'admin.login')->name('admin.login');
        Route::view('/register', 'admin.register')->name('admin.register');
        Route::post('/authenticate', [AdminAuthController::class, 'adminAuthenticate'])->name('admin.authenticate');
        Route::post('/register/update', [AdminAuthController::class, 'registerUpdate'])->name('admin.register.update');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'view'])->name('admin.dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // Pickup-delivery list
        Route::get('/pickup-delivery/list', [PickupDeliveryController::class, 'list'])->name('pickup-delivery.list');
        Route::get('/pickup-delivery/list/export', [PickupDeliveryController::class, 'export'])->name('pickup-delivery.list.export');
        Route::post('/reschedule/date', [PickupDeliveryController::class, 'rescheduleDate'])->name('pickup-delivery.reschedule');
        Route::post('/risk-comment', [PickupDeliveryController::class, 'riskCommends'])->name('pickup-delivery.commends');
        Route::post('/risk-status', [PickupDeliveryController::class, 'riskStatus'])->name('pickup-delivery.status');
        Route::post('/risk-status/pending', [PickupDeliveryController::class, 'riskStatusPending'])->name('risk.status');
        Route::post('/booking/cancel', [PickupDeliveryController::class, 'bookingCancel'])->name('booking.cancel');
        Route::post('/booking/pending/cancel', [PickupDeliveryController::class, 'bookingPendingCancel'])->name('pending.cancel');
        Route::get('/booking/search', [PickupDeliveryController::class, 'fetchBookings'])->name('booking.search');
        Route::get('/check-payment/models', [PickupDeliveryController::class, 'calculatePrice'])->name('model.price');
        Route::post('/user-payment/link', [PickupDeliveryController::class, 'sendUserPayment'])->name('user.send.payment');
        Route::post('/user/save', [PickupDeliveryController::class, 'createBooking'])->name('user.booking');
        Route::get('/booking/complete', [PickupDeliveryController::class, 'bookingComplete'])->name('complete.booking');
        Route::get('/booking/pending', [PickupDeliveryController::class, 'bookingPending'])->name('pending.booking');
        Route::get('/booking/pending/search', [PickupDeliveryController::class, 'fetchPendingBookings'])->name('pending.search');
        Route::post('/booking/revert', [PickupDeliveryController::class, 'revertBooking'])->name('revert.booking');
        Route::get('/booking/cancel', [PickupDeliveryController::class, 'bookingCancelList'])->name('cancel.booking.list');

        // Cars list
        Route::get('/cars/list', [CarDetailsController::class, 'list'])->name('car.list');
        Route::get('/cars/history/list', [CarDetailsController::class, 'history_list']);
        Route::get('/cars/history/list/export', [CarDetailsController::class, 'history_list_export'])->name('export-csv');
        Route::post('/car/save', [CarDetailsController::class, 'save'])->name('car.save');
        Route::delete('/car/{id?}/delete', [CarDetailsController::class, 'delete'])->name('car.delete');
        Route::get('/cars/search', [CarDetailsController::class, 'search'])->name('cars.search');

        // Car Models
        Route::post('/car/model/save', [CarDetailsController::class, 'saveModels'])->name('model.save');

        // Car-block list
        Route::get('/car-block/list', [CarBlockController::class, 'list'])->name('car-block.list');
        Route::get('/car-block/list/history', [CarBlockController::class, 'history'])->name('car-block.history');
        Route::get('/car-block/list/history/export', [CarBlockController::class, 'export'])->name('car-block.export');
        Route::post('/car-block/save', [CarBlockController::class, 'save'])->name('car-block.save');
        Route::put('/car-block/update', [CarBlockController::class, 'update'])->name('car-block.update');
        Route::delete('/car-block/{id?}/delete', [CarBlockController::class, 'delete'])->name('car-block.delete');
        Route::get('/car-block/search', [CarBlockController::class, 'search'])->name('car-block.search');
        Route::get('/get-car-models', [CarBlockController::class, 'getCarModelsByHub'])->name('car-model.hub');
        Route::get('/get-car-registration-numbers', [CarBlockController::class, 'getCarRegistrationNumbersByModel'])->name('car-model.register_number');


        // Car-Swap list
        Route::get('/car-swap/list', [SwapController::class, 'list'])->name('car-swap.list');
        Route::get('/car-swap/table', [SwapController::class, 'table'])->name('car-swap.table');
        Route::get('/get/booking_date', [SwapController::class, 'getBookingDate'])->name('fetch.booking.date');
        Route::get('/available/cars', [SwapController::class, 'availableCars'])->name('available.cars');
        Route::get('/swap/search', [SwapController::class, 'searchHistory'])->name('history.cars');
        Route::post('/swap/car', [SwapController::class, 'swapCar'])->name('swap.car');
        Route::get('/calculate/swap/car', [SwapController::class, 'swapCarCalculate'])->name('calculate.swap.car');
        Route::post('/payment/link', [SwapController::class, 'sendPayment'])->name('send.payment');

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

        // Map Section
        Route::get('/city-map', [MapController::class, 'show'])->name('city.map');
        Route::post('/save-area', [MapController::class, 'store'])->name('area.store');
        Route::get('/get-city-coordinates', [MapController::class, 'getCityCoordinates'])->name('area.Coordinates');


        // Front-end Car - Info Section
        Route::get('/ipr-info', [BannerController::class, 'iprInfo'])->name('ipr-info.view');
        Route::post('/ipr-info/save', [BannerController::class, 'iprSave'])->name('ipr-info.save');


        //Holidays Section
        Route::get('/holiday/list', [HolidayController::class, 'list'])->name('holidays.list');
        Route::post('/holiday/save', [HolidayController::class, 'save'])->name('holiday.save');
        Route::delete('/holiday/{id?}/delete', [HolidayController::class, 'delete'])->name('holiday.delete');
        Route::get('/holiday/search', [HolidayController::class, 'search'])->name('holiday.search');

        //City Section
        Route::get('/city/list', [CityController::class, 'list'])->name('city.list');
        Route::post('/city/save', [CityController::class, 'save'])->name('city.save');
        Route::delete('/city/{id?}/delete', [CityController::class, 'delete'])->name('city.delete');
        //        Route::get('/holiday/search', [HolidayController::class, 'search'])->name('holiday.search');

        // Front-end Banner Section
        Route::get('/general', [BannerController::class, 'generalList'])->name('general.list');
        Route::post('/general/save', [BannerController::class, 'generalSave'])->name('general.save');

        Route::get('/car-available', [AvailableController::class, 'availableList'])->name('car-available.list');
        Route::get('/check-available', [AvailableController::class, 'available'])->name('available');

        // User List
        Route::get('/user/list', [UserController::class, 'list'])->name('user.list');
        Route::get('/user/list/export', [UserController::class, 'users_export'])->name('user.list.export');
        Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
    });
});
