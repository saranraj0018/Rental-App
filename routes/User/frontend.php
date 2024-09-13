<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;


Route::get('/', [UserController::class,'view'])->name('home');
Route::view('/test', 'dummy')->name('dummy');

Route::post('/update-location', [UserController::class, 'updateLocation']);

Route::post('/api/save-geolocation', function (Request $request) {
    $latitude = !empty($request['latitude']) ? $request['latitude'] : null;
    $longitude = !empty($request['longitude']) ? $request['longitude'] : null;

    // Store geolocation in session
    $request->session()->put('latitude', $latitude);
    $request->session()->put('longitude', $longitude);

    return response()->json(['status' => 'success']);
});


//Route::group(['middleware' => 'check.location'], function () {
//    Route::get('/search-car/list', [UserController::class,'listCars'])->name('search-car.list');
//    Route::get('/book/{model_id?}', [UserController::class, 'bookingCar'])->name('book.car');
//});
Route::get('/search-car/list', [UserController::class,'listCars'])->name('search-car.list');
Route::get('/book/{model_id?}', [UserController::class, 'bookingCar'])->name('book.car');
