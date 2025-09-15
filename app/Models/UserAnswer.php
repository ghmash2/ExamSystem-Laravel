<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table='user_answers';
    protected $fillable = [
         'user_id',
         'exam_id',
         'join_at',
         'end_at',
         'correct_answer',
         'not_answered',
         'status'
    ];

    public function answer_options()
    {
        return $this->hasMany(AnswerOption::class,'answer_id');
    }
}
