<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer_has_respondent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_answer_respondent';
    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
    public function respondent()
    {
        return $this->belongsTo(Respondent::class, 'respondent_id');
    }
}
