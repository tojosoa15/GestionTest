<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_form';

    public function form_pages()
    {
        return $this->hasMany(Form_page::class, 'form_id');
    }
    public function respondents()
    {
        return $this->hasMany(Respondent::class, 'form_id');
    }
}
