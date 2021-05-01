<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_role';
   
    protected $fillable = [
        'nom_role',
    ];
    public function users()
    {
        return $this->hasMany(\App\User::class,'role_id');
    }
}
