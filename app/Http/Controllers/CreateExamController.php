<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Http\Requests\CreateExamRequest;
use App\Http\Requests\OptionRequest;
use App\Http\Resources\LauncedExamResource;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
class CreateExamController extends BaseController
{
    public function __construct() {
        $this->middleware('permission:create_full_exam')->only('store');
    }
    public function store(CreateExamRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $examData = $request->except('questions');
            $exam = Exam::create($examData);

            $questionsData = $request->input('questions', []);
            foreach ($questionsData as $questionData) {
                // Ensure the exam_id is set for the nested question
                $questionData['exam_id'] = $exam->id;
                $optionsData = $questionData['options'] ?? [];
                unset($questionData['options']);

                $question = $exam->questions()->create($questionData);

                if (!empty($optionsData)) {
                    // Prepare the options data for bulk insertion
                    $optionsForInsert = collect($optionsData)->map(function ($option) use ($question) {
                        return [
                            'title' => $option['title'],
                            'is_correct' => $option['is_correct'],
                            'question_id' => $question->id,
                        ];
                    })->toArray();

                    // Bulk insert options to reduce database queries
                    $question->options()->insert($optionsForInsert);
                }
            }

            DB::commit();

            return ApiResponseClass::sendResponse(new LauncedExamResource($exam), 'Exam Create Successful', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponseClass::sendResponse([], 'Failed to create exam.',500,$e->getMessage());
        }
    }
}



