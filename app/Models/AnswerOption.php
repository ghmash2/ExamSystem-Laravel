<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerOption extends Model
{
    protected $table='answer_options';
    protected $fillable = [
         'answer_id',
         'question_id',
         'status',
         'solution',
         'answer_at'
    ];
    public function user_answer()
    {
        return $this->belongsTo(UserAnswer::class);
    }
}
