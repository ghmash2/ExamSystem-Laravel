<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LauncedExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'title' => $this->title,
        'tagline' => $this->tagline,
        'exam_date' => $this->exam_date,
        'exam_start_time' => $this->exam_start_time,
        'exam_end_time' => $this->exam_end_time,
        'instruction' =>  $this->instruction,
        'full_mark' =>  $this->full_mark,
        'duration' =>  $this->duration,
        'can_view_result' =>  $this->can_view_result,
        'is_question_random' => $this->is_question_random,
        'is_option_random' =>  $this->is_option_random,
        'is_signin_required' => $this->is_signin_required,
        'is_specific_student' =>  $this->is_specific_student,
        'questions' => QuestionResource::collection($this->whenLoaded('questions'))
        ];
    }
}
