<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_answer';
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
    public function answer_has_respondents()
    {
        return $this->hasMany(Answer_has_respondent::class, 'answer_id');
    }
}
