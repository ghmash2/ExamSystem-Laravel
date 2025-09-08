<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'title' => '',
        'tagline' => '',
        'exam_date' => '',
        'exam_start_time' => '',
        'exam_end_time' => '',
        'instruction' => '',
        'full_mark' => '',
        'duration' => '',
        'can_view_result' => '',
        'is_question_random' => '',
        'is_option_random' => '',
        'is_signin_required' => '',
        'is_specific_student' => ''
        ];
    }
}
