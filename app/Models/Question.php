<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_question';

    protected $fillable = [
    ];
    public function form_page()
    {
        return $this->belongsTo(Form_page::class, 'form_page_id');
    }
    public function type_question()
    {
        return $this->belongsTo(Type_question::class, 'type_question_id');
    }
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
