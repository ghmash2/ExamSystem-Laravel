<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Http\Resources\LauncedExamResource;
use App\Models\Exam;

use Illuminate\Routing\Controller as BaseController;

class LauchExamController extends BaseController
{
    public function __construct() {
        $this->middleware('permission:launch_exam')->only('launch');
    }
    public function launch($exam_id)
    {
            $exam = Exam::with('questions.options')->findOrFail($exam_id);
            return ApiResponseClass::sendResponse(new LauncedExamResource($exam), 'Exam Questions with Options', 200);
    }
}
