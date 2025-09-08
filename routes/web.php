<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::post('register', AuthController::class);
// Route::post('login', AuthController::class);
// Route::get('logout', AuthController::class);

Route::resource('users', UserController::class);
Route::resource('exams', ExamController::class);


