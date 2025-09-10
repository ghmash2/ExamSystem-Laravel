<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table='questions';
    protected $fillable = [
         'title',
         'question_type',
         'status',
         'exam_id'
    ];
    protected $hidden = [

    ];

}
