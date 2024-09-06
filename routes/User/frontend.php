<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


Route::get('/', [UserController::class,'view'])->name('home');
Route::view('/test', 'dummy')->name('dummy');
Route::post('/update-location', [UserController::class, 'updateLocation']);

