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
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'exam_date' => 'date',
            'exam_start_time' => 'date_format:H:i:s',
            'exam_end_time' => 'date_format:H:i:s',
            'instruction' => 'nullable|string',
            'full_mark' => 'required|numeric',
            'duration' => 'required|integer',
            'can_view_result' => 'nullable|boolean',
            'is_question_random' => 'nullable|boolean',
            'is_option_random' => 'nullable|boolean',
            'is_signin_required' => 'nullable|boolean',
            'is_specific_student' => 'nullable|boolean',
            'questions' => 'array',
            'questions.*.title' => 'string',
            'questions.*.question_type' => 'string|in:mcq,short_answer', // Adjust as needed
            'questions.*.status' => 'nullable|integer',
            'questions.*.options' => 'nullable|array',
            'questions.*.options.*.title' => 'required_with:questions.*.options|string',
            'questions.*.options.*.is_correct' => 'required_with:questions.*.options|boolean',
        ];
    }
}
