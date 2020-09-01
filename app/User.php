<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'identification', 'city', 'address', 'phone', 'name_company', 'nit_company', 'logo_company', 'owner_company', 'email', 'password', 'status', 'expiration_date'
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

    public function customer(){
        return $this->hasMany('App\customer');
    }

    public function typeofexpense(){
        return $this->hasMany('App\typeofexpense');
    }

    public function expense(){
        return $this->hasMany('App\expense');
    }
    
}
