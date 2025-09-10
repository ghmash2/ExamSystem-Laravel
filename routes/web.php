<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamLauncher;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExamController::class, 'index']);

Route::get('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class,'logout']);

Route::resource('users', UserController::class);
Route::resource('exams', ExamController::class);
Route::resource('questions', QuestionController::class);
Route::resource('options', OptionController::class);
Route::resource('exam_launch', ExamLauncher::class);

