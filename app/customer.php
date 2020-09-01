<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    public function proposal(){
        return $this->hasMany('App\proposal');
    }

    public function sale(){
        return $this->hasMany('App\sale');
    }

    public function task(){
        return $this->hasMany('App\task');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
