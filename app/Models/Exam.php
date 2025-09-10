<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exams';
    protected $fillable = [
        'title',
        'tagline',
        'exam_date',
        'exam_start_time',
        'exam_end_time',
        'instruction',
        'full_mark',
        'duration',
        'can_view_result',
        'is_question_random',
        'is_option_random',
        'is_signin_required',
        'is_specific_student'
    ];
    protected $hidden = [

    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
