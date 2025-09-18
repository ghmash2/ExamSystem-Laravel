<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateExamController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\LauchExamController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/', [ExamController::class, 'index']);
Route::apiResource('/exams', ExamController::class)->only('index');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logoutAll', [AuthController::class, 'logoutAll']);
    Route::get('/exams/{exam}/launch', [LauchExamController::class, 'launch'])->name('exam.luanch');
    Route::post('/exams/{exam}/submit', [ResultController::class, 'evaluate'])->name('exam.submit');
    Route::apiResource('/users', UserController::class)->except(['update']);
    Route::post('/users/{user}', [UserController::class, 'update']);
    Route::get('/history', [UserController::class, 'history']);
    Route::get('/single_exam_history/{user_exam}', [UserController::class, 'single_exam_history']);
    Route::apiResource('/questions', QuestionController::class);
    Route::apiResource('/options', OptionController::class);
    Route::apiResource('/departments', DepartmentController::class);
    Route::apiResource('/students', StudentController::class);
    Route::apiResource('/exams', ExamController::class)->except('index');
    Route::post('/exams/add', [CreateExamController::class, 'store']);
});



// /exam/{exam}/submit  ---> POST evalute return result as response
// /users/{user}/exams  ----> GET all exams of a user
// /user/{user}/exams/{exam} ----> GET details of specific exam by specific user
