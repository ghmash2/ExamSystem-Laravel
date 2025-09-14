<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExamRequest;
use App\Http\Requests\OptionRequest;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class CreateExamController extends Controller
{
    public function store(CreateExamRequest $request)
    {
        $request->validated();

        $options = $request->input('exams.questions.options');
        Option::create($options);

        $questions = $request->input('exams.questions');
        unset($questions['options']);
        Question::create($questions);

        $exam = $request->input('exams');
        unset($exam['questions']);
        Exam::create($exam);

    }
}
