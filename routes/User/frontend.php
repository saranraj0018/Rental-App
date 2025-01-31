<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CouponController;
use App\Http\Controllers\User\OTPController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\LocationController;


Route::get('/', [UserController::class, 'view'])->name('home');
Route::view('/test', 'dummy')->name('dummy');

Route::post('/update-location', [UserController::class, 'updateLocation']);

Route::get('/search-car/list', [UserController::class, 'listCars'])->name('search-car.list');
Route::get('/book/{model_id?}', [UserController::class, 'bookingCar'])->name('book.car');

Route::post('user/send-otp', [OTPController::class, 'sendOTP'])->name('send.otp');
Route::post('user/verify-otp', [OTPController::class, 'verifyOtp'])->name('verify.otp');
Route::post('user/register', [OTPController::class, 'register'])->name('register');
Route::get('user/check-auth', function () {
    return response()->json(['isAuthenticated' => auth()->check()]);
});

Route::middleware(['auth'])->group(function () {

    Route::post('user/check-location', [LocationController::class, 'checkLocation']);
    Route::get('/user/verify-document', [OTPController::class, 'verifyDocument'])->name('verify.document');
    Route::get('/user/verify-booking', [OTPController::class, 'verifyBooking'])->name('verify.booking');

    Route::post('user/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');
    Route::post('user/remove-coupon', [CouponController::class, 'removeCoupon'])->name('remove.coupon');
    Route::post('user/generate/order', [CouponController::class, 'getOrderId'])->name('get.order');

    // upload documents
    Route::post('user/documentation', [UserController::class, 'storeDocuments'])->name('store.documents');
    Route::post('user/payment', [PaymentController::class, 'orderBooking'])->name('order.booking');
    Route::view('booking/success', 'user.frontpage.booking.success')->name('booking.success');
    Route::post('user/calculate-price', [PaymentController::class, 'calculatePrice'])->name('calculate.price');
    Route::post('user/complete-payment', [PaymentController::class, 'completePayment'])->name('payment.complete');
    Route::post('user/reschedule/generate/order', [PaymentController::class, 'getRescheduleOrderId'])->name('get.reschedule.order');
    Route::post('user/booking/cancel', [PaymentController::class, 'bookingCancel'])->name('user.booking.cancel');

    // upload documents
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('user/document/update', [UserController::class, 'updateUser'])->name('update.user');
    Route::post('user/document/update/docs', [UserController::class, 'updateUserDocs'])->name('update.user-docs');
    Route::post('user/document', [UserController::class, 'updateUserDocument'])->name('update.user.document');
    Route::post('user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('booking/history', [PaymentController::class, 'bookingHistory'])->name('booking.history');
    Route::post('user/update-delivery-fee', [PaymentController::class, 'updateDeliveryFee'])->name('update.fee');
    Route::delete('/user-documents/{id}', [UserController::class, 'destroy'])->name('user-documents.destroy');

});



Route::view('user/about', '.user.frontpage.others.about')->name('about');
Route::view('user/contact', '.user.frontpage.others.contact')->name('contact');
Route::view('user/cancellation', '.user.frontpage.others.cancellation')->name('cancellation');
Route::view('user/pricing', '.user.frontpage.others.pricing')->name('pricing');
Route::view('user/faq', '.user.frontpage.others.faq')->name('faq');
Route::view('user/privacy-policy', '.user.frontpage.others.privacy-policy')->name('privacy-policy');
Route::view('user/blog', '.user.frontpage.others.blog')->name('blog');
Route::view('user/refund', '.user.frontpage.others.refund')->name('refund');
Route::view('user/shipping', '.user.frontpage.others.shipping')->name('shipping');
Route::view('user/terms-and-conditions', '.user.frontpage.others.terms-and-conditions')->name('terms-and-conditions');
Route::view('user/blog', '.user.frontpage.others.blog')->name('blog');

