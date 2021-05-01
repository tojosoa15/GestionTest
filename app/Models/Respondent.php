<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_respondent';
    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
    public function answer_has_respondents()
    {
        return $this->hasMany(Answer_has_respondent::class, 'respondent_id');
    }
}
