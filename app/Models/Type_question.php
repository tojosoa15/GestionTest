<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_type_question';
    public function questions()
    {
        return $this->hasMany(Question::class, 'type_question_id');
    }
}
