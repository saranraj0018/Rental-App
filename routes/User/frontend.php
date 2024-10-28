<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CouponController;
Use App\Http\Controllers\User\OTPController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\LocationController;


Route::get('/', [UserController::class,'view'])->name('home');
Route::view('/test', 'dummy')->name('dummy');

Route::post('/update-location', [UserController::class, 'updateLocation']);

Route::get('/search-car/list', [UserController::class,'listCars'])->name('search-car.list');
Route::get('/book/{model_id?}', [UserController::class, 'bookingCar'])->name('book.car');

Route::post('user/send-otp', [OTPController::class, 'sendOTP'])->name('send.otp');
Route::post('user/verify-otp', [OTPController::class, 'verifyOtp'])->name('verify.otp');
Route::post('user/register', [OTPController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/verify-document', [OTPController::class,'verifyDocument'])->name('verify.document');

    Route::post('user/apply-coupon', [CouponController::class,'applyCoupon'])->name('apply.coupon');
    Route::post('user/remove-coupon', [CouponController::class, 'removeCoupon'])->name('remove.coupon');

    // upload documents
    Route::post('user/documentation', [UserController::class, 'storeDocuments'])->name('store.documents');
    Route::post('user/payment', [PaymentController::class, 'orderBooking'])->name('order.booking');
    Route::view('booking/success', 'user.frontpage.booking.success')->name('booking.success');
    Route::post('user/calculate-price', [PaymentController::class, 'calculatePrice'])->name('calculate.price');
    Route::post('user/complete-payment', [PaymentController::class, 'completePayment'])->name('payment.complete');
    Route::post('user/booking/cancel', [PaymentController::class, 'bookingCancel'])->name('user.booking.cancel');

    // upload documents
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('user/download/{filename}', [UserController::class, 'downloadFile'])->name('download.file');
    Route::post('user/document/update', [UserController::class, 'updateUser'])->name('update.user');
    Route::post('user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('booking/history', [PaymentController::class, 'bookingHistory'])->name('booking.history');
    Route::post('user/update-delivery-fee', [PaymentController::class, 'updateDeliveryFee'])->name('update.fee');
});

Route::post('user/check-location', [LocationController::class, 'checkLocation']);


Route::view('user/about', '.user.frontpage.others.about')->name('about');
Route::view('user/contact', '.user.frontpage.others.contact')->name('contact');
Route::view('user/cancellation', '.user.frontpage.others.cancellation')->name('cancellation');
Route::view('user/pricing', '.user.frontpage.others.pricing')->name('pricing');
Route::view('user/faq', '.user.frontpage.others.faq')->name('faq');
Route::view('user/privacy-policy', '.user.frontpage.others.privacy-policy')->name('privacy-policy');
Route::view('user/refund', '.user.frontpage.others.refund')->name('refund');
Route::view('user/shipping', '.user.frontpage.others.shipping')->name('shipping');
Route::view('user/terms-and-conditions', '.user.frontpage.others.terms-and-conditions')->name('terms-and-conditions');

