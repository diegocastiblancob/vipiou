<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
