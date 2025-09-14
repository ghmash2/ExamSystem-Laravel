<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Http\Resources\LauncedExamResource;
use App\Models\Exam;
use Illuminate\Http\Request;

class LauchExamController extends Controller
{
    public function launch($exam_id)
    {
        $exam = Exam::with( 'questions.options')->findOrFail($exam_id);
        return ApiResponseClass::sendResponse(new LauncedExamResource($exam),'Exam Questions with Options', 200);
    }
}
