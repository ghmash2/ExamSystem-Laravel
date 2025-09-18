<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamLauncher;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [ExamController::class, 'index']);

// Route::resource('exams', ExamController::class)->except(['show']);
// Route::get('exams/{exam}', [ExamController::class, 'start']);

// Route::middleware(['prevent.navigation'])->group(function () {
//     Route::resource('exams', ExamController::class)->only(['show']);
//     Route::post('exam/submit', [ExamController::class, 'submit'])->name('exam.submit');
// });
