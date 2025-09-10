<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
     protected $table='options';
    protected $fillable = [
     'title',
     'is_correct',
     'question_id'
    ];
    protected $hidden = [

    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
