<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'role_id');
    }
    public function photo()
    {
        return $this->morphOne(\App\Models\Mediatheque_autre::class, 'mediatheque_autre','','id_table');
    }
    public function photos()
    {
        return $this->morphToMany(\App\Models\Mediatheque::class, 'mediatheque_autre','mediatheque_autres','id_table','mediatheque_id');
    }
}
