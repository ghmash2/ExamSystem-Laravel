<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'exams.title' => ['required', 'string'],
            // 'exams.duration' => ['required', 'integer'],
            'title' => 'min:1',
            'tagline' => 'min:1',
            'exam_date' => 'date',
            'exam_start_time' => '',
            'exam_end_time' => '',
            'instruction' => 'min:1',
            'full_mark' => 'integer',
            'duration' => 'integer',
            'can_view_result' => '',
            'is_question_random' => '',
            'is_option_random' => '',
            'is_signin_required' => '',
            'is_specific_student' => '',

            'exams.questions' => 'array',
            'exams.questions.*.exam_id' => '',
            'exams.questions.*.title' => 'string',

            'exams.questions.options' => 'array',
            'exams.questions.*.option.*.question_id' => '',
            'exams.questions.*.option.*.title' => 'string',
            'exams.questions.*.option.*.is_correct' => 'boolean',
        ];
    }
}
