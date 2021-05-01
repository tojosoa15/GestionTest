<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_page extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_form_page';

    protected $fillable = [
    ];
    public function questions()
    {
        return $this->hasMany(Question::class, 'form_page_id');
    }
    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }

}
