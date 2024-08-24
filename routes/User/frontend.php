<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


Route::get('/', [UserController::class,'view'])->name('home');
