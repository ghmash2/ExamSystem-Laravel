<?php

namespace App\Http\Controllers;

use App\Models\AnswerOption;
use App\Models\Exam;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function evaluate(Request $request)
    {
        $validated = $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'user_id' => 'required|exists:users,id',
            'join_at' => '',
            'end_at' => '',
            'status' => '',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.answer_at' => 'exists:options,id',
        ]);

        $exam = Exam::with('questions.options')->find($validated['exam_id']);
        $userScore = 0;
        $notAnswered = 0;
        $user_answer = UserAnswer::create([
            'exam_id' => $exam->id,
            'user_id' => $validated['user_id'],
            'join_at' => $validated['join_at'],
            'end_at' => $validated['end_at'],
            'not_answered' => null,
            'correct_answer' => null
        ]);

        foreach ($validated['answers'] as $submittedAnswer) {
            $questionId = $submittedAnswer['question_id'];
            $selectedOptionId = $submittedAnswer['answer_at'];

            // Get the question from the exam model loaded with its options
            $question = $exam->questions->firstWhere('id', $questionId);

            if ($question) {
                $correctOption = $question->options->firstWhere('is_correct', 1);
                $correctOptionId = $correctOption->id ?? null;

                if ($selectedOptionId == null)
                    $notAnswered++;

                $isCorrect = ($selectedOptionId == $correctOptionId);
                if ($isCorrect) {
                    $userScore++;
                }
                AnswerOption::create([
                    'answer_id' => $user_answer->id,
                    'question_id' =>  $questionId,
                    'solution' => $correctOptionId,
                    'answer_at' => $selectedOptionId
                ]);
            }
        }
         $user_answer->not_answered = $notAnswered;
         $user_answer->correct_answer = $userScore;
         $user_answer->save();

        
    }
}
