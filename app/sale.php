<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    public function credit(){
        return $this->hasMany('App\credit');
    }

    public function customer(){
        return $this->belongsTo('App\customer', 'customer_id');
    }
}
